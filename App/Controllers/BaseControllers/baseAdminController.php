<?php

namespace App\Controllers\BaseControllers;

use FrameworkWesllen\Http\Controller;

class baseAdminController extends Controller{

	public function __loadVars($request, $response, $app){
		parent::__loadVars($request, $response, $app);

		$this->service->layout('App/Views/Admin/tamplate/tamplate.phtml');
	}



	
}
