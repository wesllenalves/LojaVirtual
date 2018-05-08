<?php

namespace App\Controllers\BaseControllers;

use FrameworkWesllen\Http\Controller;

class baseHomeController extends Controller{

	public function __loadVars($request, $response, $app){
		parent::__loadVars($request, $response, $app);

		$this->service->layout('App/Views/Home/tamplate/tamplate.phtml');
	}



	
}
