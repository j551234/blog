<?php

namespace App\Http\Controllers;
use Illuminate\Routing\Controller as BaseController;
use View;
use App\Pixnet;



class indexController extends Controller {
	public function index()
	{
		$pixnetdata = Pixnet::orderBy('search_time', 'desc')->paginate(12); 
		return view('index',['pixnetdata'=>$pixnetdata]);
	 

	}
		public function popular()
	{
		$pixnetdata = Pixnet::orderBy('search_view', 'desc')->paginate(12); 
		return view('index',['pixnetdata'=>$pixnetdata]);
	 


	}
		public function appraise()
	{
		$pixnetdata = Pixnet::orderBy('totalscore', 'desc')->paginate(12); 
		return view('index',['pixnetdata'=>$pixnetdata]);

	}
		public function random()
	{
		$data= Pixnet::all();
		$a=rand(0,count($data));
		$pixnetdata = Pixnet::where('id','>',"$a")->paginate(12);
	 
		return view('index',['pixnetdata'=>$pixnetdata]);
	 


	}
 	
}