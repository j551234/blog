<?php

namespace App\Http\Controllers;
use Illuminate\Routing\Controller as BaseController;
use View;



class indexController extends Controller {
	public function index()
	{
		
		return View::make('index');
	 

	}
 	
}