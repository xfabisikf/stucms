<?php namespace App\Controllers\Admin;
 
use App\Models\User;
use App\Services\Validators\UserValidator;
use App\Services\Validators\UserValidatorUpdate;
use Input, Notification, Redirect, Sentry, Str;
 
class UsersController extends \BaseController {
 
    public function index()
    {
        if(Input::get('orderby') && Input::get('ord'))
        {
            if(in_array(Input::get('orderby'), array('id','email','created_at')) &&
                in_array(Input::get('ord'), array('desc','asc')))
            {
                $users = User::orderBy(Input::get('orderby'), Input::get('ord'))->wherePermissions(0)->get();
            }
            else
            {
                $users = User::wherePermissions(0)->get();
            }
        }
        else
        {
            $users = User::wherePermissions(0)->get();
        }

        return \View::make('admin.users.index')->with('users', $users);
    }
 
    public function create()
    {
        return \View::make('admin.users.create');
    }
 
    public function store()
    {
        $validation = new UserValidator;

        if ($validation->passes())
        {
            $user = new User;
            $user->email       = Input::get('email');
            $user->password    = Input::get('password');
            $user->permissions = array(0);
            $user->activated   = (int) Input::get('activated');
            $user->save();

            Notification::success('The user was saved.');
 
            return Redirect::route('admin.users.index', $user->id);
        }
 
        return Redirect::back()->withInput()->withErrors($validation->errors);
    }
 
    public function edit($id)
    {
        return \View::make('admin.users.edit')->with('user', User::find($id));
    }
 
    public function update($id)
    {
        $validation = new UserValidatorUpdate;
 
        if ($validation->passes())
        {
            $user = User::find($id);
            $user->password    = Input::get('password');
            $user->activated   = (int) Input::get('activated');
            $user->save();
 
            Notification::success('The user was saved.');
 
            return Redirect::route('admin.users.index', $user->id);
        }
 
        return Redirect::back()->withInput()->withErrors($validation->errors);
    }
 
    public function destroy($id)
    {
        $user = User::find($id);
        if (User::wherePermissions(0)->get())
        {
            $user->delete();
            
            Notification::success('The user was deleted.');
 
            return Redirect::route('admin.users.index');
        }
        else
        {
            Notification::info('The administrator can`t be deleted.');
 
            return Redirect::route('admin.users.index');
        }
    }
}