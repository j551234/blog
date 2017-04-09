<?php

namespace App\Http\Controllers;
use Illuminate\Routing\Controller as BaseController;
use View;
use App\Pixnet;



class indexController extends Controller {
	public function index()
	{
		$pixnetdata = Pixnet::orderBy('search_time', 'desc')->paginate(6); 
		return view('index',['pixnetdata'=>$pixnetdata]);
	 

	}
 	
}