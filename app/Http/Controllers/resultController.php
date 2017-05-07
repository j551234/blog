<?php

namespace App\Http\Controllers;
use Illuminate\Routing\Controller as BaseController;

use Illuminate\Pagination\Paginator;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use View;
use App\Pixnet;
use App\Xuite;
use App\Ptt;
use App\Youtube;
use App\Mobile01;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;




class resultController extends Controller {
	public function index(Request $request)
			{
			
				$search = $request->input('search');
				$searchtype = $request->input('searchtype');
				if($searchtype==null)
				{
					$searchtype="title";
				}
				$searchweb = $request->input('searchweb');
			
			
				if($searchweb!=null){
					$searchweb=implode(",",$searchweb);
				}
				elseif ($searchweb==null) {
					$searchweb="rpixnet,rxuite,rptt,ryoutube,rmobile01";
				}
				

				
				
				
				



			
					
			
				$key_word = $search;
				$url_key_word=urlencode(mb_convert_encoding($key_word, 'utf-8'));
				
				$pixnetfind=pixnet::where('key_word','like',"%$search%")->get();
				$xuitefind=xuite::where('key_word','like',"%$search%")->get();
				$pttfind=ptt::where('key_word','like',"%$search%")->get();
				$youtubefind=youtube::where('key_word','like',"%$search%")->get();
				


			
				if(count($pixnetfind)==0){		
						$file1 = popen("start/b C://xampp/htdocs/project/python/SearchPixnet.py $url_key_word",'r');
						pclose($file1);
						 				}
			  	 if(count($xuitefind)==0){
						$file2 = popen("start/b C://xampp/htdocs/project/python/SearchPtt.py $url_key_word",'r');  
						pclose($file2);
						 				}
				if(count($pttfind)==0){
						$file3 = popen("start/b C://xampp/htdocs/project/python/SearchXuite.py $url_key_word",'r');  
						pclose($file3); 
										}
				if(count($youtubefind)==0){
						$file4 = popen("start/b C://xampp/htdocs/project/python/SearchYoutube.py $url_key_word",'r'); 
			 			pclose($file4);
										}
				
			

				return view('wait',['search'=> $search,'searchtype'=>$searchtype,'searchweb'=>$searchweb]);

			
			}
	public function pixnetscore(Request $request)
			{
				// echo $request->id;
				$value = (int)$request->currentRating;
				$score_people=pixnet::where('id',$request->id)
				->increment('score_people');
				$total_score=pixnet::where('id',$request->id)
				->increment('total_score',$value);



		   //      $search = $request->input('search');
		 		// $resultdata = Pixnet::where('search_title','like',"%$search%")
		 		// ->paginate(5);
				$pixnetchange = pixnet::find($request->id);
				return $pixnetchange->toJson();
			}
	public function xuitescore(Request $request)
			{

				$value = (int)$request->currentRating;
				$score_people=Xuite::where('id',$request->id)
				->increment('score_people');
				$total_score=Xuite::where('id',$request->id)
				->increment('total_score',$value);



				$xuitechange = xuite::find($request->id);
				return $xuitechange->toJson();
			}
	public function pttscore(Request $request)
			{

				$value = (int)$request->currentRating;
				
				$score_people=Ptt::where('id',$request->id)
				->increment('score_people');
				$toal_score=ptt::where('id',$request->id)
				->increment('total_score',$value);



				$pttchange = Ptt::find($request->id);
				return $pttchange->toJson();
			}
	public function youtubescore(Request $request)
			{

				$value = (int)$request->currentRating;

				$score_people=youtube::where('id',$request->id)
				->increment('score_people');
				$total_score=youtube::where('id',$request->id)
				->increment('total_score',$value);



				$youtubechange = youtube::find($request->id);
				return $youtubechange->toJson();
			}


	public function mobile01score(Request $request)
			{

				$value = (int)$request->currentRating;
				
				$score_people=Mobile01::where('id',$request->id)
				->increment('score_people');
				$toal_score=Mobile01::where('id',$request->id)
				->increment('total_score',$value);



				$mobile01change = Mobile01::find($request->id);
				return $mobile01change->toJson();
			}
	public function show(Request $request)
			{	
				$search = $request->input('search');
				$searchtype = $request->input('searchtype');
				$searchweb = $request->input('searchweb');
				$pagenumber=2;
			
				

				

				if($searchtype=='author')
					{   
						$rawDataPixnet=Pixnet::where('search_author','like',"%$search%");
						$rawDataXuite=Xuite::where('search_author','like',"%$search%");
						$rawDataPtt=Ptt::where('search_author','like',"%$search%");
						$rawDataYoutube=Youtube::where('search_author','like',"%$search%");
						$rawDataMobile01=Mobile01::where('search_author','like',"%$search%");
					}
				else
					{
						
						$rawDataPixnet=Pixnet::where('search_title','like',"%$search%");
						$rawDataXuite=Xuite::where('search_title','like',"%$search%");
						$rawDataPtt=Ptt::where('search_title','like',"%$search%");
						$rawDataYoutube=Youtube::where('search_title','like',"%$search%");
						$rawDataMobile01=Mobile01::where('search_title','like',"%$search%");
					}
				if($searchweb!=null)

				{
						
				
					if (strpos ($searchweb,'pixnet')==false)
						{
							$rawDataPixnet=[];
							$pagenumber++;


						}	
					if (strpos ($searchweb,'xuite')==false)
						{
							$rawDataXuite=[];
							$pagenumber++;

						}	
					if (strpos ($searchweb,'ptt')==false)
						{
							$rawDataPtt =[];
							$pagenumber++;
						}	 
					if (strpos ($searchweb,'youtube')==false)
						{
							$rawDataYoutube=[];
							$pagenumber++;

						}
					if (strpos ($searchweb,'mobile01')==false)
						{
							$rawDataMobile01=[];
							$pagenumber++;

						}
				}
				$number=array(count($rawDataPixnet),count($rawDataXuite),count($rawDataPtt),
					count($rawDataYoutube),count($rawDataMobile01));
				$whoIsTheBestDog=array_search(max($number),$number);		
				


			
				if(count($rawDataPixnet)!=0)
				{
					$pixnetdata = $rawDataPixnet->paginate($pagenumber);
				}
				elseif($rawDataPixnet==[])
				{
					$pixnetdata = [];
				}

				if(count($rawDataXuite)!=0)
				{
					$xuitedata = $rawDataXuite->paginate($pagenumber);	
				}
				elseif ($rawDataXuite==[])
				{
					$xuitedata = [];	
				}
				if (count($rawDataPtt)!=0)
				{
					$pttdata=$rawDataPtt->paginate($pagenumber);
				}
				elseif ($rawDataPtt==[])
				{
					$pttdata= [];	
				}
				if(count($rawDataYoutube)!=0)
				{
					$youtubedata= $rawDataYoutube->paginate($pagenumber);
				}
				elseif($rawDataYoutube==[])
				{
					$youtubedata=[];
				}
				if(count($rawDataMobile01)!=0)
				{
					
					$mobile01data=$rawDataMobile01->paginate($pagenumber);
					

				}
				elseif($rawDataMobile01==[]) {
					$mobile01data=[];
				}

			 	switch ($whoIsTheBestDog) {
			 		case 0:
			 			$whoIsTheBestDog=$pixnetdata;
			 			break;
			 		case 1:
			 			$whoIsTheBestDog=$xuitedata;
			 			break;
			 		case 2:
			 			$whoIsTheBestDog=$pttdata;
			 			break;
			 		case 3:
			 			$whoIsTheBestDog=$youtubedata;
			 			break;
			 		case 4:
			 			$whoIsTheBestDog=$mobile01data;
			 			break;
			 		default:
			 			exit("fuck");
			 			break;
			 	}



			
				return view('result',['pixnetdata'=>$pixnetdata,
					'xuitedata'=>$xuitedata,'pttdata'=>$pttdata,
					'youtubedata'=>$youtubedata,'mobile01data'=>$mobile01data
					,'whoIsTheBestDog'=>$whoIsTheBestDog,'search'=> $search,'searchtype'=>$searchtype,'searchweb'=>$searchweb]);
			}
	public function popular (Request $request)
			{	
				$search = $request->input('search');
			
				$searchtype = $request->input('searchtype');
				if($searchtype==null)
				{
					$searchtype="title";
				}
				$searchweb = $request->input('searchweb');
				$pagenumber=2;
			
				

				

				if($searchtype=='author')
					{   
						$rawDataPixnet=Pixnet::where('search_author','like',"%$search%");
						$rawDataXuite=Xuite::where('search_author','like',"%$search%");
						$rawDataPtt=Ptt::where('search_author','like',"%$search%");
						$rawDataYoutube=Youtube::where('search_author','like',"%$search%");
						$rawDataMobile01=Mobile01::where('search_author','like',"%$search%");
					}
				else
					{
						
						$rawDataPixnet=Pixnet::where('search_title','like',"%$search%");
						$rawDataXuite=Xuite::where('search_title','like',"%$search%");
						$rawDataPtt=Ptt::where('search_title','like',"%$search%");
						$rawDataYoutube=Youtube::where('search_title','like',"%$search%");
						$rawDataMobile01=Mobile01::where('search_title','like',"%$search%");
					}
				if($searchweb!=null)

				{
						
				
					if (strpos ($searchweb,'pixnet')==false)
						{
							$rawDataPixnet=[];
							$pagenumber++;


						}	
					if (strpos ($searchweb,'xuite')==false)
						{
							$rawDataXuite=[];
							$pagenumber++;

						}	
					if (strpos ($searchweb,'ptt')==false)
						{
							$rawDataPtt =[];
							$pagenumber++;
						}	 
					if (strpos ($searchweb,'youtube')==false)
						{
							$rawDataYoutube=[];
							$pagenumber++;

						}
					if (strpos ($searchweb,'mobile01')==false)
						{
							$rawDataMobile01=[];
							$pagenumber++;

						}
				}
				$number=array(count($rawDataPixnet),count($rawDataXuite),count($rawDataPtt),
					count($rawDataYoutube),count($rawDataMobile01));
				$whoIsTheBestDog=array_search(max($number),$number);		
				


			
				if(count($rawDataPixnet)!=0)
				{
					$pixnetdata = $rawDataPixnet
					->orderBy('search_view', 'desc')
					->paginate($pagenumber);
				}
				elseif($rawDataPixnet==[])
				{
					$pixnetdata = [];
				}

				if(count($rawDataXuite)!=0)
				{
					$xuitedata = $rawDataXuite
					->orderBy('score_people', 'desc')
					->paginate($pagenumber);	
				}
				elseif ($rawDataXuite==[])
				{
					$xuitedata = [];	
				}
				if (count($rawDataPtt)!=0)
				{
					$pttdata=$rawDataPtt
					->orderBy('push_count', 'desc')
					->paginate($pagenumber);
				}
				elseif ($rawDataPtt==[])
				{
					$pttdata= [];	
				}
				if(count($rawDataYoutube)!=0)
				{
					$youtubedata= $rawDataYoutube
					->orderBy('push_count', 'desc')
					->paginate($pagenumber);
				}
				elseif($rawDataYoutube==[])
				{
					$youtubedata=[];
				}
				if(count($rawDataMobile01)!=0)
				{
					
					$mobile01data=$rawDataMobile01
					->orderBy('search_view', 'desc')
					->paginate($pagenumber);
					

				}
				elseif($rawDataMobile01==[]) {
					$mobile01data=[];
				}

			 	switch ($whoIsTheBestDog) {
			 		case 0:
			 			$whoIsTheBestDog=$pixnetdata;
			 			break;
			 		case 1:
			 			$whoIsTheBestDog=$xuitedata;
			 			break;
			 		case 2:
			 			$whoIsTheBestDog=$pttdata;
			 			break;
			 		case 3:
			 			$whoIsTheBestDog=$youtubedata;
			 			break;
			 		case 4:
			 			$whoIsTheBestDog=$mobile01data;
			 			break;
			 		default:
			 			exit("fuck");
			 			break;
			 	}



			
				return view('result',['pixnetdata'=>$pixnetdata,
					'xuitedata'=>$xuitedata,'pttdata'=>$pttdata,
					'youtubedata'=>$youtubedata,'mobile01data'=>$mobile01data
					,'whoIsTheBestDog'=>$whoIsTheBestDog,'search'=> $search,'searchtype'=>$searchtype,'searchweb'=>$searchweb]);

			}
	public function appraise (Request $request)
			{	
				$search = $request->input('search');
			
				$searchtype = $request->input('searchtype');
				if($searchtype==null)
				{
					$searchtype="title";
				}
				$searchweb = $request->input('searchweb');
				$pagenumber=2;
			
				

				

				if($searchtype=='author')
					{   
						$rawDataPixnet=Pixnet::where('search_author','like',"%$search%");
						$rawDataXuite=Xuite::where('search_author','like',"%$search%");
						$rawDataPtt=Ptt::where('search_author','like',"%$search%");
						$rawDataYoutube=Youtube::where('search_author','like',"%$search%");
						$rawDataMobile01=Mobile01::where('search_author','like',"%$search%");
					}
				else
					{
						
						$rawDataPixnet=Pixnet::where('search_title','like',"%$search%");
						$rawDataXuite=Xuite::where('search_title','like',"%$search%");
						$rawDataPtt=Ptt::where('search_title','like',"%$search%");
						$rawDataYoutube=Youtube::where('search_title','like',"%$search%");
						$rawDataMobile01=Mobile01::where('search_title','like',"%$search%");
					}
				if($searchweb!=null)

				{
						
				
					if (strpos ($searchweb,'pixnet')==false)
						{
							$rawDataPixnet=[];
							$pagenumber++;


						}	
					if (strpos ($searchweb,'xuite')==false)
						{
							$rawDataXuite=[];
							$pagenumber++;

						}	
					if (strpos ($searchweb,'ptt')==false)
						{
							$rawDataPtt =[];
							$pagenumber++;
						}	 
					if (strpos ($searchweb,'youtube')==false)
						{
							$rawDataYoutube=[];
							$pagenumber++;

						}
					if (strpos ($searchweb,'mobile01')==false)
						{
							$rawDataMobile01=[];
							$pagenumber++;

						}
				}
				$number=array(count($rawDataPixnet),count($rawDataXuite),count($rawDataPtt),
					count($rawDataYoutube),count($rawDataMobile01));
				$whoIsTheBestDog=array_search(max($number),$number);		
				


			
				if(count($rawDataPixnet)!=0)
				{
					$pixnetdata = $rawDataPixnet
					->orderBy('total_score', 'desc')
					->paginate($pagenumber);
				}
				elseif($rawDataPixnet==[])
				{
					$pixnetdata = [];
				}

				if(count($rawDataXuite)!=0)
				{
					$xuitedata = $rawDataXuite
					->orderBy('total_score', 'desc')
					->paginate($pagenumber);	
				}
				elseif ($rawDataXuite==[])
				{
					$xuitedata = [];	
				}
				if (count($rawDataPtt)!=0)
				{
					$pttdata=$rawDataPtt
					->orderBy('total_score', 'desc')
					->paginate($pagenumber);
				}
				elseif ($rawDataPtt==[])
				{
					$pttdata= [];	
				}
				if(count($rawDataYoutube)!=0)
				{
					$youtubedata= $rawDataYoutube
					->orderBy('total_score', 'desc')
					->paginate($pagenumber);
				}
				elseif($rawDataYoutube==[])
				{
					$youtubedata=[];
				}
				if(count($rawDataMobile01)!=0)
				{
					
					$mobile01data=$rawDataMobile01
					->orderBy('total_score', 'desc')
					->paginate($pagenumber);
					

				}
				elseif($rawDataMobile01==[]) {
					$mobile01data=[];
				}

			 	switch ($whoIsTheBestDog) {
			 		case 0:
			 			$whoIsTheBestDog=$pixnetdata;
			 			break;
			 		case 1:
			 			$whoIsTheBestDog=$xuitedata;
			 			break;
			 		case 2:
			 			$whoIsTheBestDog=$pttdata;
			 			break;
			 		case 3:
			 			$whoIsTheBestDog=$youtubedata;
			 			break;
			 		case 4:
			 			$whoIsTheBestDog=$mobile01data;
			 			break;
			 		default:
			 			exit("fuck");
			 			break;
			 	}



			
				return view('result',['pixnetdata'=>$pixnetdata,
					'xuitedata'=>$xuitedata,'pttdata'=>$pttdata,
					'youtubedata'=>$youtubedata,'mobile01data'=>$mobile01data
					,'whoIsTheBestDog'=>$whoIsTheBestDog,'search'=> $search,'searchtype'=>$searchtype,'searchweb'=>$searchweb]);

			}
			public function random(Request $request)
			{	
				$search = $request->input('search');
			
				$searchtype = $request->input('searchtype');
				if($searchtype==null)
				{
					$searchtype="title";
				}
				$searchweb = $request->input('searchweb');
				$pagenumber=2;
		
				

				

				if($searchtype=='author')
					{   
						$rawDataPixnet=Pixnet::where('search_author','like',"%$search%");
						$rawDataXuite=Xuite::where('search_author','like',"%$search%");
						$rawDataPtt=Ptt::where('search_author','like',"%$search%");
						$rawDataYoutube=Youtube::where('search_author','like',"%$search%");
						$rawDataMobile01=Mobile01::where('search_author','like',"%$search%");
					}
				else
					{
						
						$rawDataPixnet=Pixnet::where('search_title','like',"%$search%");
						$rawDataXuite=Xuite::where('search_title','like',"%$search%");
						$rawDataPtt=Ptt::where('search_title','like',"%$search%");
						$rawDataYoutube=Youtube::where('search_title','like',"%$search%");
						$rawDataMobile01=Mobile01::where('search_title','like',"%$search%");
					}
				if($searchweb!=null)

				{
						
				
					if (strpos ($searchweb,'pixnet')==false)
						{
							$rawDataPixnet=[];
							$pagenumber++;


						}	
					if (strpos ($searchweb,'xuite')==false)
						{
							$rawDataXuite=[];
							$pagenumber++;

						}	
					if (strpos ($searchweb,'ptt')==false)
						{
							$rawDataPtt =[];
							$pagenumber++;
						}	 
					if (strpos ($searchweb,'youtube')==false)
						{
							$rawDataYoutube=[];
							$pagenumber++;

						}
					if (strpos ($searchweb,'mobile01')==false)
						{
							$rawDataMobile01=[];
							$pagenumber++;

						}
				}
				$number=array(count($rawDataPixnet),count($rawDataXuite),count($rawDataPtt),
					count($rawDataYoutube),count($rawDataMobile01));
				$whoIsTheBestDog=array_search(max($number),$number);		
				


			
				if(count($rawDataPixnet)!=0)
				{
					
			
					$pixnetdata = $rawDataPixnet::inRandomOrder()->get();
				}
				elseif($rawDataPixnet==[])
				{
					$pixnetdata = [];
				}

				if(count($rawDataXuite)!=0)
				{
					
					$xuitedata = $rawDataXuite::inRandomOrder()->get();
						
				}
				elseif ($rawDataXuite==[])
				{
					$xuitedata = [];	
				}
				if (count($rawDataPtt)!=0)
				{
					
					$pttdata = $rawDataPtt::inRandomOrder()->get();
					
				}	
				elseif ($rawDataPtt==[])
				{
					$pttdata= [];	
				}
				if(count($rawDataYoutube)!=0)
				{
					
					$youtubedata = $rawDataYoutube::inRandomOrder()->get();
					
				}
				elseif(count($rawDataYoutube)==[])
				{
					$youtubedata=[];
				}
				if(count($rawDataMobile01)!=0)
				{
					
					
					$mobiledata = $rawDataMobile01::inRandomOrder()->get();
                }
				elseif($rawDataMobile01==[]) 
				{
					$mobile01data=[];
				}

			 	switch ($whoIsTheBestDog) {
			 		case 0:
			 			$whoIsTheBestDog=$pixnetdata;
			 			break;
			 		case 1:
			 			$whoIsTheBestDog=$xuitedata;
			 			break;
			 		case 2:
			 			$whoIsTheBestDog=$pttdata;
			 			break;
			 		case 3:
			 			$whoIsTheBestDog=$youtubedata;
			 			break;
			 		case 4:
			 			$whoIsTheBestDog=$mobile01data;
			 			break;
			 		default:
			 			exit("fuck");
			 			break;
			 	}



			
				return view('result',['pixnetdata'=>$pixnetdata,
					'xuitedata'=>$xuitedata,'pttdata'=>$pttdata,
					'youtubedata'=>$youtubedata,'mobile01data'=>$mobile01data
					,'whoIsTheBestDog'=>$whoIsTheBestDog,'search'=> $search,'searchtype'=>$searchtype,'searchweb'=>$searchweb]);

			}






}