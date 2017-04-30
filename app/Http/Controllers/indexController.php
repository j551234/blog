<?php

namespace App\Http\Controllers;
use Illuminate\Routing\Controller as BaseController;
use View;
use App\Pixnet;
use App\Xuite;
use App\Ptt;
use App\Youtube;
use App\Indexxuite;
use App\Http\Requests\StoreBlogPost;
use Illuminate\Http\Request;



class indexController extends Controller {
	

	public function index(Request $request){
	  
		$show= $request->input('show');
		if($show!=null)
			{
				if($show=='pixnet')
					$showdata =pixnet::orderBy('id', 'desc')->paginate(12); 
				if($show=='xuite')
					$showdata =xuite::orderBy('id', 'desc')->paginate(12); 
				if($show=='ptt')
					$showdata =ptt::orderBy('id', 'desc')->paginate(12);
				if($show=='youtube')
					$showdata =youtube::orderBy('id', 'desc')->paginate(12); }
		else
			{
				$showdata =pixnet::orderBy('id', 'desc')->paginate(12); 

			}


			return view('index',['showdata'=>$showdata]);
	

	 

	}
		public function popular(Request $request){
		 $show= $request->input('show');
			if($show=='pixnet')
				$showdata =pixnet::orderBy('search_view', 'desc')->paginate(12); 
			if($show=='xuite')
				$showdata =xuite::orderBy('search_title', 'desc')->paginate(12); 
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

				$showdata = pixnet::whereBetween('id',array($a,$a+5))->paginate(6); }
			if($show=='xuite')
			{$b=rand(0,count($rand2->all()));
				$showdata =xuite::whereBetween('id',array($b,$b+5))->paginate(6);}
			if($show=='ptt')
			{$c=rand(0,count($rand3->all()));
 					$showdata =ptt::whereBetween('id',array($c,$c+5))->paginate(6); }
			if($show=='youtube')
			{$d=rand(0,count($rand4->all()));
				$showdata =youtube::whereBetween('id',array($d,$d+5))->paginate(6);}
			
	 
			return view('index',['showdata'=>$showdata]);
	}
	public function category(Request $request){
		$tag= $request->input('tag');
		$xuitedata = indexxuite::where('tag','=',$tag)->paginate(12); 
 
		return view('index',['showdata'=>$xuitedata]);
	 

	}
 	
}