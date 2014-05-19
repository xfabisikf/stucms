<?php namespace App\Controllers\Admin;

use App\Models\Subject;
use App\Models\Settings;
use App\Services\Validators\SubjectValidator;
use Image, Input, Notification, Redirect, Sentry, Str;

class SubjectsController extends \BaseController {

	public function index()
	{
		if(Input::get('orderby') && Input::get('ord'))
        {
            if(in_array(Input::get('orderby'), array('id','title','created_at')) &&
                in_array(Input::get('ord'), array('desc','asc')))
            {
                $subjects = Subject::orderBy(Input::get('orderby'), Input::get('ord'))->get();
            }
            else
            {
                $subjects = Subject::all();
            }
        }
        else
        {
            $subjects = Subject::all();
        }

		return \View::make('admin.subjects.index')->with(array('subjects' => $subjects));
	}

	public function getSubjectsFromAis()
	{	
		$settings = Settings::find(1);
		$depart = $settings->depart;
		
		$url = 'http://is.stuba.sk/katalog/index.pl';
		$ch = curl_init();
		$timeout = 5;
		curl_setopt($ch, CURLOPT_URL , $url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
		curl_setopt($ch, CURLOPT_POST, 2);
		curl_setopt($ch, CURLOPT_POST, true);
		curl_setopt($ch, CURLOPT_HTTPHEADER, array('Accept-Language: sk-SK;q=0.6,sk;q=0.4'));
		curl_setopt($ch, CURLOPT_POSTFIELDS, 'jak=dle_pracovist&fakulta=21030&obdobi_fak=374&&ustav='.$depart.'&vypsat=1');
		$html = curl_exec($ch);

		curl_close($ch);

		$domW = new \DOMDocument();
		@$domW->loadHTML($html);

		$url = 'http://is.stuba.sk/katalog/index.pl';
		$ch = curl_init();
		$timeout = 5;
		curl_setopt($ch, CURLOPT_URL , $url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
		curl_setopt($ch, CURLOPT_POST, 2);
		curl_setopt($ch, CURLOPT_POST, true);
		curl_setopt($ch, CURLOPT_HTTPHEADER, array('Accept-Language: sk-SK;q=0.6,sk;q=0.4'));
		curl_setopt($ch, CURLOPT_POSTFIELDS, 'jak=dle_pracovist&fakulta=21030&obdobi_fak=375&&ustav='.$depart.'&vypsat=1');
		$html = curl_exec($ch);

		curl_close($ch);

		$domS = new \DOMDocument();
		@$domS->loadHTML($html);

		return \View::make('admin.subjects.fromais')->with(array('domW' => $domW, 'domS' => $domS));
	}

	public function setSubjectsFromAis()
	{
		$input = Input::all();

		include('simple_html_dom.php');

		foreach ($input as $item)
		{
			$href = explode("@", $item);
			$subject = Subject::where('title', $href[1])->first();
			if (!empty($subject))
			{
				Notification::warning('The subjects '.$href[1].' already exist.');

				return Redirect::route('admin.subjects.index', $subject->id);
			}
		}

		foreach ($input as $item)
		{
			$href = explode("@", $item);

			$url = 'http://is.stuba.sk/katalog/';
			$ch = curl_init();
			$timeout = 5;
			curl_setopt($ch, CURLOPT_URL , $url.$href[0]);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
			curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
			curl_setopt($ch, CURLOPT_HTTPHEADER, array('Accept-Language: sk-SK;q=0.6,sk;q=0.4'));
			$html = curl_exec($ch);
			curl_close($ch);
			
			$pars = new \simple_html_dom();
			$pars->load($html);

			$pars2 = new \simple_html_dom();
			foreach($pars->find('div[class=mainpage]') as $result)
				$pars2->load($result->outertext);

			$pars = $pars2->find('table',0);
			foreach ($pars->find('a') as $result)
				$result->href = NULL;
			
			foreach ($pars->find('td[width=100]') as $result) 
				$result->width = 180;

			$subject = new Subject;
			$subject->title   = $href[1];
			$subject->slug    = Str::slug($href[1]);
			$subject->body    = $pars;
			if ($href[2] == 'W'){
			$subject->semester = 0;
			} elseif ($href[2] == 'S'){
			$subject->semester = 1;
			}
			$subject->visible = 0;
			$subject->user_id = Sentry::getUser()->id;
			$subject->save();
		}
		Notification::success('The subjects from AIS was saved.');

		return Redirect::route('admin.subjects.index', $subject->id);
	}

	public function show($id)
	{
		return \View::make('admin.subjects.show')->with('subject', Subject::find($id));
	}

	public function create()
	{
		return \View::make('admin.subjects.create');
	}

	public function store()
	{
		$validation = new SubjectValidator;

		if ($validation->passes())
		{
			$subject = new Subject;
			$subject->title    = Input::get('title');
			$subject->slug     = Str::slug(Input::get('title'));
			$subject->body     = Input::get('body');
			$subject->semester = Input::get('semester');
			$subject->visible  = Input::get('visible');
			$subject->user_id  = Sentry::getUser()->id;
			$subject->save();

			Notification::success('The subject was saved.');

			return Redirect::route('admin.subjects.index', $subject->id);
		}

		return Redirect::back()->withInput()->withErrors($validation->errors);
	}

	public function edit($id)
	{
		$subject = Subject::find($id);
        $title = $subject->title;
        $semester = $subject->semester;
        $visible = $subject->visible;
        return \View::make('admin.subjects.edit')->with(array('subject' => $subject, 'title' => $title, 'semester' => $semester, 'visible' => $visible));
	}

	public function update($id)
	{
		$validation = new SubjectValidator;

		if ($validation->passes())
		{
			$subject = Subject::find($id);
			$subject->title   = Input::get('title');
			$subject->slug    = Str::slug(Input::get('title'));
			$subject->body    = Input::get('body');
			$subject->semester = Input::get('semester');
			$subject->visible  = Input::get('visible');
			$subject->user_id = Sentry::getUser()->id;
			$subject->save();

			Notification::success('The subject was saved.');

			return Redirect::route('admin.subjects.index', $subject->id);
		}

		return Redirect::back()->withInput()->withErrors($validation->errors);
	}

	public function destroy($id)
	{
		$subject = Subject::find($id);
		$subject->delete();

		Notification::success('The subject was deleted.');

		return Redirect::route('admin.subjects.index');
	}

	public function duplicate($id)
	{
		$subject = Subject::find($id);
		$newSubject = new Subject;
		$newSubject->title = $subject->title.'_new';
		$newSubject->slug = Str::slug($subject->title).'-new';
		$newSubject->body = $subject->body;
		$newSubject->semester = $subject->semester;
		$newSubject->visible  = $subject->visible;
		$newSubject->user_id = Sentry::getUser()->id;
		$newSubject->save();

		Notification::success('The subject was duplicated.');

		return Redirect::route('admin.subjects.index', $newSubject->id);
	}
}