<?php

namespace App\Http\Controllers;
use Illuminate\Routing\Controller as BaseController;
use View;
use App\Pixnet;
use App\Xuite;
use App\Ptt;
use App\Youtube;
use App\Indexxuite;
use App\Indexpixnet;
use App\Indexptt;
use App\Indexyoutube;

use App\Http\Requests\StoreBlogPost;
use Illuminate\Http\Request;



class indexController extends Controller {
	

	public function index(Request $request){
	  	$tag= $request->input('tag');
		$show= $request->input('show');
		if($tag==null)
			{
				if($show!=null)
					{

					if($show=='pixnet')
						$showdata =pixnet::orderBy('id', 'desc')->paginate(12); 
					if($show=='xuite')
						$showdata =xuite::orderBy('id', 'desc')->paginate(12); 
					if($show=='ptt')
						$showdata =ptt::orderBy('id', 'desc')->paginate(12);

					if($show=='youtube')
						$showdata =youtube::orderBy('id', 'desc')->paginate(12); 
					}
					else
					{
						$showdata =pixnet::orderBy('id', 'desc')->paginate(12);
					}
				$tag=null;
			}
		else
			{
				if($show!=null){
					if($show=='pixnet')
							{$showdata =indexpixnet::where('tag','=',$tag)->paginate(12); }
					if($show=='xuite')
							{$showdata =indexxuite::where('tag','=',$tag)->paginate(12); }
					if($show=='ptt')
							{$showdata =indexptt::where('tag','=',$tag)->paginate(12); }
					if($show=='youtube')
							{$showdata =indexyoutube::where('tag','=',$tag)->paginate(12); }
					}
			
					
				else{
					$showdata =pixnet::orderBy('id', 'desc')->paginate(12);
					$show==null;
				}

			}


			return view('index',['showdata'=>$showdata,'tag'=>$tag,'show'=>$show]); }
		public function popular(Request $request){
				$show= $request->input('show');
				$tag= $request->input('tag');
		
			if($tag==null)
					{
						if($show!=null)
							{

							if($show=='pixnet')
								$showdata =pixnet::orderBy('search_view', 'desc')->paginate(12); 
							if($show=='xuite')
								$showdata =xuite::orderBy('search_title', 'desc')->paginate(12); 
							if($show=='ptt')
								$showdata =ptt::orderBy('push_count', 'desc')->paginate(12);

							if($show=='youtube')
								$showdata =youtube::orderBy('push_count', 'desc')->paginate(12); 
							}
							else
							{
								$showdata =pixnet::orderBy('id', 'desc')->paginate(12);
							}
						$tag=null;
					}
				else
					{
						if($show!=null){
							if($show=='pixnet')
								{	$showdata =indexpixnet::where('tag','=',$tag)
									->orderBy('score_people', 'desc')
									->paginate(12); }
							if($show=='xuite')
									{$showdata =indexxuite::where('tag','=',$tag)
									->orderBy('score_people', 'desc')
									->paginate(12); }
							if($show=='ptt')
									{$showdata =indexptt::where('tag','=',$tag)
									->orderBy('score_people', 'desc')
									->paginate(12); }
							if($show=='youtube')
									{$showdata =indexyoutube::where('tag','=',$tag)
									->orderBy('score_people', 'desc')
									->paginate(12); }
							}
					
							
						else{
							$showdata =pixnet::orderBy('id', 'desc')->paginate(12);
							$show==null;
						}
					}


			return view('index',['showdata'=>$showdata,'tag'=>$tag,'show'=>$show]);
		 


	}
		public function appraise(Request $request){

		$show= $request->input('show');
		
		$tag= $request->input('tag');
		$show= $request->input('show');
				if($tag==null)
					{
						if($show!=null)
							{

							if($show=='pixnet')
								$showdata =pixnet::orderBy('total_score', 'desc')->paginate(12); 
							if($show=='xuite')
								$showdata =xuite::orderBy('total_score', 'desc')->paginate(12); 
							if($show=='ptt')
								$showdata =ptt::orderBy('total_score', 'desc')->paginate(12);

							if($show=='youtube')
								$showdata =youtube::orderBy('total_score', 'desc')->paginate(12); 
							}
							else
							{
								$showdata =pixnet::orderBy('id', 'desc')->paginate(12);
							}
						$tag=null;
					}
				else
					{
						if($show!=null){
							if($show=='pixnet')
								{	$showdata =indexpixnet::where('tag','=',$tag)
									->orderBy('total_score', 'desc')
									->paginate(12); }
							if($show=='xuite')
									{$showdata =indexxuite::where('tag','=',$tag)
									->orderBy('total_score', 'desc')
									->paginate(12); }
							if($show=='ptt')
									{$showdata =indexptt::where('tag','=',$tag)
									->orderBy('total_score', 'desc')
									->paginate(12); }
							if($show=='youtube')
									{$showdata =indexyoutube::where('tag','=',$tag)
									->orderBy('total_score', 'desc')
									->paginate(12); }
							           }
					
							
						else{
							$showdata =pixnet::orderBy('id', 'desc')->paginate(12);
							$show==null;
						    }
					}

			



			return view('index',['showdata'=>$showdata,'tag'=>$tag,'show'=>$show]);

	

	}
		public function random(Request $request){
		$tag= $request->input('tag');
		$show= $request->input('show');
					
			$rand1=pixnet::all();
			$rand2=xuite::all();
			$rand3=ptt::all();
			$rand4=youtube::all();

			$rand5=indexpixnet::all();
			$rand6=indexxuite::all();
			$rand7=indexptt::all();
			$rand8=indexyoutube::all();
			if($tag==null)
					{
						if($show!=null)
							{
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
							}
							else
							{
								$showdata =pixnet::orderBy('id', 'desc')->paginate(12);
							}
						$tag=null;
					}
			else{
						if($show!=null){
									if($show=='pixnet')
									 {$e=rand(0,count($rand1->all()));
										$showdata = indexpixnet::whereBetween('id',array($e,$e+5))->paginate(6); }
									if($show=='xuite')
									 {$f=rand(0,count($rand2->all()));
										$showdata =indexxuite::whereBetween('id',array($f,$f+5))->paginate(6);}
									if($show=='ptt')
									 {$g=rand(0,count($rand3->all()));
				 						$showdata =indexptt::whereBetween('id',array($g,$g+5))->paginate(6); }
									if($show=='youtube')
									 {$h=rand(0,count($rand4->all()));
										$showdata =indexyoutube::whereBetween('id',array($h,$h+5))->paginate(6);}
							}
					
							
						else{
							$showdata =pixnet::orderBy('id', 'desc')->paginate(12);
							$show==null;
						    }
					}


				
	 
			return view('index',['showdata'=>$showdata,'tag'=>$tag,'show'=>$show]);
	}
	public function category(Request $request){
			$tag= $request->input('tag');
			$show= $request->input('show');
				if($tag==null)
					{
						if($show!=null)
							{

							if($show=='pixnet')
								$showdata =pixnet::orderBy('id', 'desc')->paginate(12); 
							if($show=='xuite')
								$showdata =xuite::orderBy('id', 'desc')->paginate(12); 
							if($show=='ptt')
								$showdata =ptt::orderBy('id', 'desc')->paginate(12);

							if($show=='youtube')
								$showdata =youtube::orderBy('id', 'desc')->paginate(12); 
							}
							else
							{
								$showdata =pixnet::orderBy('id', 'desc')->paginate(12);
							}
						$tag=null;
					}
				else
					{
						if($show!=null){
							if($show=='pixnet')
									{$showdata =indexpixnet::where('tag','=',$tag)->paginate(12); }
							if($show=='xuite')
									{$showdata =indexxuite::where('tag','=',$tag)->paginate(12); }
							if($show=='ptt')
									{$showdata =indexptt::where('tag','=',$tag)->paginate(12); }
							if($show=='youtube')
									{$showdata =indexyoutube::where('tag','=',$tag)->paginate(12); }
							}
					
							
						else{
							$showdata =pixnet::orderBy('id', 'desc')->paginate(12);
							$show==null;
						}
					}

			return view('index',['showdata'=>$showdata,'tag'=>$tag,'show'=>$show]); }
		}