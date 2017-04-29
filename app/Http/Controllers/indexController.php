<?php

namespace App\Http\Controllers;
use Illuminate\Routing\Controller as BaseController;
use View;
use App\Pixnet;
use App\Xuite;
use App\Ptt;
use App\Youtube;
use App\Http\Requests\StoreBlogPost;
use Illuminate\Http\Request;



class indexController extends Controller {
	public function showpixnet(){
		$pixnetdata = Pixnet::orderBy('id', 'desc')->paginate(12); 
 
		return view('index',['showdata'=>$pixnetdata]);
	 

	}
	public function showxuite(){
		$xuite = xuite::orderBy('id', 'desc')->paginate(12); 

		return view('index',['showdata'=>$xuite]);
	 

	}

	public function showptt(){
		$ptt = ptt::orderBy('id', 'desc')->paginate(12); 

		return view('index',['showdata'=>$ptt]);
	 

	}
		public function showyoutube(){
		$youtube=youtube::orderBy('id', 'desc')->paginate(12); 
	 
		return view('index',['showdata'=>$youtube]);
	 

	}












	public function index(){
	  
		$pixnetdata = Pixnet::orderBy('search_time', 'desc')->paginate(12); 
	
		return view('index',['showdata'=>$pixnetdata]);
	 

	}
		public function popular(Request $request){
		 $show= $request->input('show');
			if($show=='pixnet')
				$showdata =pixnet::orderBy('search_view', 'desc')->paginate(12); 
			if($show=='xuite')
				$showdata =xuite::orderBy('search_view', 'desc')->paginate(12); 
			if($show=='ptt')
				$showdata =ptt::orderBy('push_count', 'desc')->paginate(12);
			if($show=='youtube')
				$showdata =youtube::orderBy('push_count', 'desc')->paginate(12);

			return view('index',['showdata'=>$showdata]);
		 


	}
		public function appraise(Request $request){

		$show= $request->input('show');
			if($show=='pixnet')
				$showdata =pixnet::orderBy('total_score', 'desc')->paginate(12); 
			if($show=='xuite')
				$showdata =xuite::orderBy('total_score', 'desc')->paginate(12); 
			if($show=='ptt')
				$showdata =ptt::orderBy('total_score', 'desc')->paginate(12);
			if($show=='youtube')
				$showdata =youtube::orderBy('total_score', 'desc')->paginate(12);

			return view('index',['showdata'=>$showdata]);
	

	}
		public function random(Request $request){		
			$rand1=pixnet::all();
			$rand2=xuite::all();
			$rand3=ptt::all();
			$rand4=youtube::all();
			$show= $request->input('show');
			if($show=='pixnet')
				
				{$a=rand(0,count($rand1->all()));
				$showdata = pixnet::where('id','>','$a')->paginate(12); }
			if($show=='xuite')
				
				{$b=rand(10000,count($rand2->all())+10000);
				$showdata =xuite::where('id','>','$b')->paginate(12);  }
			if($show=='ptt')
				

			{	$c=rand(20000,count($rand3->all())+20000);

				$showdata =ptt::where('id','>','$c')->paginate(12); }
			if($show=='youtube')
				

				{$d=rand(30000,count($rand4->all())+30000);
				$showdata =youtube::where('id','>','$d')->paginate(12); }
			
	 
			return view('index',['showdata'=>$showdata]);
	}
 	
}