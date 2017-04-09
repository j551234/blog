<?php

namespace App\Http\Controllers;
use Illuminate\Routing\Controller as BaseController;
use View;
use App\Pixnet;



class indexController extends Controller {
	public function index()
	{
		$pixnetdata = pixnet::paginate();
		return view('index',['pixnetdata'=>$pixnetdata]);
	 

	}
 	
}