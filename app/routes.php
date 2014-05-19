<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/



View::composer('site._partials.navigation', 'App\Services\Composers\MenuComposer');

Route::get('admin/logout',  array('as' => 'admin.logout',      'uses' => 'App\Controllers\Admin\AuthController@getLogout'));
Route::get('admin/login',   array('as' => 'admin.login',       'uses' => 'App\Controllers\Admin\AuthController@getLogin'));
Route::post('admin/login',  array('as' => 'admin.login.post',  'uses' => 'App\Controllers\Admin\AuthController@postLogin'));
Route::get('admin/create',  array('as' => 'admin.create',      'uses' => 'App\Controllers\Admin\AuthController@createAdmin'));
Route::post('admin/store',  array('as' => 'admin.store',       'uses' => 'App\Controllers\Admin\AuthController@storeAdmin'));

Route::group(array('prefix' => 'admin', 'before' => 'user'), function()
{
	Route::any('/',                'App\Controllers\Admin\PagesController@index');
	Route::group(array('prefix' => 'pages'), function()
	{
		Route::get('/',             array('as' => 'admin.pages.index', 'uses'    => 'App\Controllers\Admin\PagesController@index'));
		Route::get('show/{id}',     array('as' => 'admin.pages.show', 'uses'     => 'App\Controllers\Admin\PagesController@show'));
		Route::get('create',        array('as' => 'admin.pages.create', 'uses'   => 'App\Controllers\Admin\PagesController@create'));
		Route::post('store',        array('as' => 'admin.pages.store', 'uses'    => 'App\Controllers\Admin\PagesController@store'));
		Route::get('edit/{id}',     array('as' => 'admin.pages.edit', 'uses'     => 'App\Controllers\Admin\PagesController@edit'));
		Route::post('update/{id}',  array('as' => 'admin.pages.update', 'uses'   => 'App\Controllers\Admin\PagesController@update'));
		Route::post('destroy/{id}', array('as' => 'admin.pages.destroy', 'uses'  => 'App\Controllers\Admin\PagesController@destroy'));
	});
	Route::group(array('prefix' => 'subjects'), function()
	{
		Route::get('/',               array('as' => 'admin.subjects.index', 'uses'    => 'App\Controllers\Admin\SubjectsController@index'));
		Route::get('show/{id}',       array('as' => 'admin.subjects.show', 'uses'     => 'App\Controllers\Admin\SubjectsController@show'));
		Route::get('create',          array('as' => 'admin.subjects.create', 'uses'   => 'App\Controllers\Admin\SubjectsController@create'));
		Route::post('store',          array('as' => 'admin.subjects.store', 'uses'    => 'App\Controllers\Admin\SubjectsController@store'));
		Route::get('edit/{id}',       array('as' => 'admin.subjects.edit', 'uses'     => 'App\Controllers\Admin\SubjectsController@edit'));
		Route::post('update/{id}',    array('as' => 'admin.subjects.update', 'uses'   => 'App\Controllers\Admin\SubjectsController@update'));
		Route::post('destroy/{id}',   array('as' => 'admin.subjects.destroy', 'uses'  => 'App\Controllers\Admin\SubjectsController@destroy'));
		Route::post('duplicate/{id}', array('as' => 'admin.subjects.duplicate', 'uses'=> 'App\Controllers\Admin\SubjectsController@duplicate'));
		Route::get('getsub',          array('as' => 'admin.subjects.getsub', 'uses'   => 'App\Controllers\Admin\SubjectsController@getSubjectsFromAis'));
		Route::post('setsub',         array('as' => 'admin.subjects.setsub', 'uses'   => 'App\Controllers\Admin\SubjectsController@setSubjectsFromAis'));
	});
	Route::group(array('before' => 'admin'), function()
	{
		Route::get('settings',         array('as' => 'admin.settings', 'uses'         => 'App\Controllers\Admin\SettingsController@settings'));
		Route::post('settings/depart', array('as' => 'admin.settings.depart', 'uses'  => 'App\Controllers\Admin\SettingsController@depart'));
		Route::post('settings/style',  array('as' => 'admin.settings.style', 'uses'   => 'App\Controllers\Admin\SettingsController@style'));
		Route::group(array('prefix' => 'users'), function()
		{
			Route::get('/',             array('as' => 'admin.users.index', 'uses'    => 'App\Controllers\Admin\UsersController@index'));
			Route::get('create',        array('as' => 'admin.users.create', 'uses'   => 'App\Controllers\Admin\UsersController@create'));
			Route::post('store',        array('as' => 'admin.users.store', 'uses'    => 'App\Controllers\Admin\UsersController@store'));
			Route::get('edit/{id}',     array('as' => 'admin.users.edit', 'uses'     => 'App\Controllers\Admin\UsersController@edit'));
			Route::post('update/{id}',  array('as' => 'admin.users.update', 'uses'   => 'App\Controllers\Admin\UsersController@update'));
			Route::post('destroy/{id}', array('as' => 'admin.users.destroy', 'uses'  => 'App\Controllers\Admin\UsersController@destroy'));
		});
	});
});

Route::get('{id}/{slug}',          array('as' => 'page.show', 'uses'       => 'SiteController@getPage'));
Route::get('subjects/{id}/{slug}', array('as' => 'subject.show', 'uses'    => 'SiteController@getSubject'));
Route::get('/',                    array('as' => 'page.index', 'uses'      => 'SiteController@getIndex'));
Route::get('subjects',             array('as' => 'site.subjects', 'uses'   => 'SiteController@getSubjects'));

App::error(function($exception, $code)
{
    switch ($code)
    {
        case 403:
            return Response::view('site.errors.403', array(), 403);
            
        default:
            return Response::view('site.errors.404', array(), 404);
    }
});