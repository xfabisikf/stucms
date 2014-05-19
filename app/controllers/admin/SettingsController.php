<?php

namespace App\Controllers\Admin;

use App\Models\Settings;
use Image, Input, Notification, Redirect, Sentry, Str;

class SettingsController extends \BaseController {

	public function settings()
	{
		$styl_dir = "site/assets/css";
		$styles = scandir($styl_dir);

		$settings = Settings::find(1);
		$depart = $settings->depart;
		$docst = $settings->style;
		$docsk = explode("css/", $docst);
		$styler = $docsk[1];
    	
		foreach ($styles as $key => $value)
		{
			if ($value[0] == "." || $value[0] == "_")
			{
				unset($styles[$key]);
			}
		}

		return \View::make('admin.settings')->with(array('styles' => $styles, 'depart' => $depart, 'styler' => $styler));
	}

	public function depart()
	{
		if(Settings::find(1))
		{
			$settings = Settings::find(1);
			$settings->depart = Input::get('depart');
			$settings->save();
		}
		else
		{
			$settings = new Settings;
			$settings->depart = Input::get('depart');
			$settings->save();
		}

		Notification::success('The department was saved.');

		return Redirect::route('admin.settings');
	}

	public function style()
	{
		if(Settings::find(1))
		{
			$settings = Settings::find(1);
			$settings->style = Input::get('style');
			$settings->save();
		}
		else
		{
			$settings = new Settings;
			$settings->style = Input::get('style');
			$settings->save();
		}

		Notification::success('The css style was saved.');

		return Redirect::route('admin.settings');
	}

}