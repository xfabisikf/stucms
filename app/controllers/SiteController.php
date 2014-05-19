<?php

class SiteController extends BaseController {

	public function getIndex()
	{
		if (Page::find(1))
		{
			$page = Page::find(1);

        	return View::make('site.page', compact('page'));
        }
        else
        	Redirect::route('admin.create');

	}

	public function getSubject($id, $slug)
	{
		$subject = Subject::find($id);
		if ($subject->visible == 1)
		{
			return Response::view('site.errors.403', array(), 403);
		}
		return View::make('site.subject')->with(array('subject' => $subject));
	}

	public function getPage($id, $slug)
	{
        $page = Page::find($id);

        return View::make('site.page', compact('page'));
    }

    public function getSubjects()
    {
    	$subjects = Subject::all();

    	return View::make('site.subjects')->with(array('subjects' => $subjects));
    }
}
