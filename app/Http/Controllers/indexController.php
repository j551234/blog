<?php

namespace App\Http\Controllers;
use Illuminate\Routing\Controller as BaseController;
use View;
use App\Pixnet;
use App\Xuite;
use App\Ptt;
use App\mobile01;
use App\Indexxuite;
use App\Indexpixnet;
use App\Indexptt;
use App\Indexmobile01;

use App\Http\Requests\StoreBlogPost;
use Illuminate\Http\Request;



class indexController extends Controller {
	

	public function index(Request $request){
	  	$tag= $request->input('tag');
		$show= $request->input('show');
		if($tag==null)
			{
					switch($show){
						case 'pixnet':
							$showdata =indexpixnet::orderBy('id', 'desc')->paginate(12); 
							 break;
						case 'xuite':
							$showdata =indexxuite::orderBy('id', 'desc')->paginate(12); 
							break;
						case 'ptt':
							$showdata =ptt::orderBy('id', 'desc')->paginate(12);
							break;
						case 'mobile01':
							$showdata =indexmobile01::orderBy('id', 'desc')->paginate(12); 
							break;
						case null:
							$showdata =indexmobile01::inRandomOrder()->paginate(12);
							break;
					
							}

					
				
					}

		else
			{
				
					switch($show){
						case 'pixnet':
							$showdata =indexpixnet::where('tag','=',$tag)->paginate(12);
							 break;
						case 'xuite':
							$showdata =indexxuite::where('tag','=',$tag)->paginate(12); 
							break;
						case 'ptt':
							{$showdata =indexptt::where('tag','=',$tag)->paginate(12);
							break;
						case 'mobile01':
							$showdata =indexmobile01::where('tag','=',$tag)->paginate(12);
							break;
						case null:
							$showdata =indexmobile01::inRandomOrder()->paginate(12);
							break;
					
					
					}					


			return view('index',['showdata'=>$showdata,'tag'=>$tag,'show'=>$show]); }
			
			
	
	public function category(Request $request){
			$tag= $request->input('tag');
			$show= $request->input('show');
				if($tag==null)
					{
						switch($show){
						case 'pixnet':
							$showdata =indexpixnet::orderBy('id', 'desc')->paginate(12); 
							 break;
						case 'xuite':
							$showdata =indexxuite::orderBy('id', 'desc')->paginate(12); 
							break;
						case 'ptt':
							$showdata =ptt::orderBy('id', 'desc')->paginate(12);
							break;
						case 'mobile01':
							$showdata =indexmobile01::orderBy('id', 'desc')->paginate(12); 
							break;
						case null:
							$showdata =indexmobile01::inRandomOrder()->paginate(12);
							break;
					
							}
				
					}
				else
					{
				
					switch($show){
						case 'pixnet':
							$showdata =indexpixnet::where('tag','=',$tag)->paginate(12);
							 break;
						case 'xuite':
							$showdata =indexxuite::where('tag','=',$tag)->paginate(12); 
							break;
						case 'ptt':
							{$showdata =indexptt::where('tag','=',$tag)->paginate(12);
							break;
						case 'mobile01':
							$showdata =indexmobile01::where('tag','=',$tag)->paginate(12);
							break;
						case null:
							$showdata =indexmobile01::inRandomOrder()->paginate(12);
							break;
							}
					}
			return view('index',['showdata'=>$showdata,'tag'=>$tag,'show'=>$show]); }
		}
