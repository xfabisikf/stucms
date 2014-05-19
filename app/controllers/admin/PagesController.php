<?php namespace App\Controllers\Admin;
 
use App\Models\Page;
use App\Models\User;
use App\Services\Validators\PageValidator;
use Input, Notification, Redirect, Sentry, Str;
 
class PagesController extends \BaseController {
 
    public function index()
    {
        if(Input::get('orderby') && Input::get('ord'))
        {
            if(in_array(Input::get('orderby'), array('id','title','created_at')) &&
                in_array(Input::get('ord'), array('desc','asc')))
            {
                $pages = Page::orderBy(Input::get('orderby'), Input::get('ord'))->get();
            }
            else
            {
                $pages = Page::all();
            }
        }
        else
        {
            $pages = Page::all();
        }

        return \View::make('admin.pages.index')->with('pages', $pages);
    }
 
    public function show($id)
    {
        return \View::make('admin.pages.show')->with('page', Page::find($id));
    }
 
    public function create()
    {
        return \View::make('admin.pages.create');
    }
 
    public function store()
    {
        $validation = new PageValidator;
 
        if ($validation->passes())
        {
            $page = new Page;
            $page->title   = Input::get('title');
            $page->slug    = Str::slug(Input::get('title'));
            $page->body    = Input::get('body');
            $page->user_id = Sentry::getUser()->id;
            $page->menu    = Input::get('menu');
            $page->solid   = Input::get('solid');
            $page->edit    = Input::get('edit');
            $page->save();
 
            Notification::success('The page was saved.');
 
            return Redirect::route('admin.pages.index', $page->id);
        }
 
        return Redirect::back()->withInput()->withErrors($validation->errors);
    }
 
    public function edit($id)
    {
        $page = Page::find($id);
        $title = $page->title;
        $menu = $page->menu;
        $solid = $page->solid;
        $edit = $page->edit;
        if ($edit == 1 && !Sentry::getUser()->permissions)
        {
            return Redirect::route('admin.pages.index');
        }
        else
        {
            return \View::make('admin.pages.edit')->with(array('page' => $page, 'title' => $title, 'menu' => $menu, 'edit' => $edit, 'solid' => $solid));    
        }
        
    }
 
    public function update($id)
    {
        $validation = new PageValidator;
 
        if ($validation->passes())
        {
            $page = Page::find($id);
            $page->title   = Input::get('title');
            $page->slug    = Str::slug(Input::get('title'));
            $page->body    = Input::get('body');
            $page->user_id = Sentry::getUser()->id;
            $page->menu    = Input::get('menu');
            $page->solid   = Input::get('solid');
            $page->edit    = Input::get('edit');
            $page->save();
 
            Notification::success('The page was saved.');
 
            return Redirect::route('admin.pages.index', $page->id);
        }
 
        return Redirect::back()->withInput()->withErrors($validation->errors);
    }
 
    public function destroy($id)
    {
        $page = Page::find($id);
        $page->delete();
 
        Notification::success('The page was deleted.');
 
        return Redirect::route('admin.pages.index');
    }
}