<?php 

namespace App\Services\Composers;

use Page;

class MenuComposer {

	public function compose($view){

		$pages = Page::all();
		$view->with(array('pages' => $pages));
	}
}