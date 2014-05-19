<?php namespace App\Controllers\Admin;

use App\Models\User;
use App\Services\Validators\AdminValidator;
use Auth, BaseController, Form, Input, Redirect, Sentry, View, Notification, Str;


class AuthController extends BaseController {

	public function getLogin()
	{
		if (!User::find(1))
		{
			return Redirect::route('admin.create');
		}
		return View::make('admin.auth.login');
	}
	
	public function postLogin()
	{
		$credentials = array(
			'email'    => Input::get('email'),
			'password' => Input::get('password')
		);

		try
		{
			$user = Sentry::authenticate($credentials, false);

			if ($user)
			{
				return Redirect::route('admin.pages.index');
			}
		}
		catch(\Exception $e)
		{
			return Redirect::route('admin.login')->withErrors(array('login' => $e->getMessage()));
		}
	}

	public function getLogout()
	{
		Sentry::logout();

		return Redirect::route('admin.login');
	}

	public function createAdmin()
	{
		if (User::find(1))
		{
			return Redirect::route('admin.login');
		}
		return View::make('admin.create');
	}

	public function storeAdmin()
	{
        $validation = new AdminValidator;
 
        if ($validation->passes())
        {

            $user = Sentry::getUserProvider()->create(
	        array(
	            'email'       => Input::get('email'),
	            'password'    => Input::get('password'),
	            'activated'   => 1,
        	));

            /*$user->setHasher(new Cartalyst\Sentry\Hashing\NativeHasher);
            $user->email       = Input::get('email');
            $user->password    = Input::get('password');
                        dd(123);
            $user->permissions = array(1);
            $user->activated   = array(1);
            $user->save();*/

            Notification::success('The admin was created.');
 
            return Redirect::route('admin.pages.index');
        }
 
        return Redirect::back()->withInput()->withErrors($validation->errors);
    }
}
