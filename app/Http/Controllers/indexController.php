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
		public function popular()
	{
		$pixnetdata = Pixnet::orderBy('search_view', 'desc')->paginate(6); 
		return view('index',['pixnetdata'=>$pixnetdata]);
	 


	}
		public function appraise()
	{
		$pixnetdata = Pixnet::orderBy('search_time', 'desc')->paginate(6); 
		return view('index',['pixnetdata'=>$pixnetdata]);
	 

	}
		public function random()
	{
		$a=rand(0,9);
		$pixnetdata = Pixnet::where('id','>',"$a")->paginate(6); 

		$pixnetdata = Pixnet::paginate(8);
    

		return view('index',['pixnetdata'=>$pixnetdata]);
	 

	}
 	
}