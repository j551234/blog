<?php

namespace App\Http\Controllers;
use Illuminate\Routing\Controller as BaseController;
use View;
use App\Pixnet;



class indexController extends Controller {
	public function index()
	{

		$pixnetdata = Pixnet::paginate(5);
    
		return view('index',['pixnetdata'=>$pixnetdata]);
	 

	}
 	
}