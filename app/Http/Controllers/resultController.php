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

class resultController extends Controller {
	public function index(Request $request)
	{
	
		$search = $request->input('search');
		$searchtype = $request->input('searchtype');
		$searchweb = $request->input('searchweb');
	
	
		if($searchweb!=null){
			$searchweb=implode(",",$searchweb);
		}
		$searchweb="pixnet,xuite,ptt,youtube,mobile01";

			
			
	
		$key_word = $search;
		$url_key_word=urlencode(mb_convert_encoding($key_word, 'utf-8'));
		
		$pixnetfind=pixnet::where('key_word','like',"%$search%")->get();
		$xuitefind=xuite::where('key_word','like',"%$search%")->get();
		$pttfind=ptt::where('key_word','like',"%$search%")->get();
		$youtubefind=youtube::where('key_word','like',"%$search%")->get();
		$mobile01find=mobile01::where('key_word','like',"%$search%")->get();

		


	
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
		if(count($mobile01find)==0){
				$file5 = popen("start/b C://xampp/htdocs/project/python/SearchMobile01.py $url_key_word",'r'); 
	 			pclose($file5);
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
		$null=[];
	
		

		

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
				
		
			if (strpos ($searchweb, 'pixnet')!=0)
				{$rawDataPixnet=$null;}	
			if (strpos ($searchweb, 'xuite')==false)
				{$rawDataXuite=$null;}	
			if (strpos ($searchweb, 'ptt')==false)
				{$rawDataPtt =$null;}	 
			if (strpos ($searchweb, 'youtube')==false)
				{$rawDataYoutube=$null;}
			if (strpos ($searchweb, 'mobile01')==false)
				{$rawDataMobile01=$null;}



		}		
		
		$number=array(count($rawDataPixnet),count($rawDataXuite),count($rawDataPtt),
			count($rawDataYoutube),count($rawDataMobile01));
		$whoIsTheBestDog=array_search(max($number),$number);

	
		if($rawDataPixnet!=$null)
		{
			$pixnetdata = $rawDataPixnet->paginate(2);
		}
		elseif($rawDataPixnet==$null)
		{
			$pixnetdata = $null;
		}

		if($rawDataXuite!=$null)
		{
			$xuitedata = $rawDataXuite->paginate(2);	
		}
		elseif ($rawDataXuite==$null)
		{
			$xuitedata = $null;	
		}
		if ($rawDataPtt!=$null)
		{
			$pttdata=$rawDataPtt->paginate(2);
		}
		elseif ($rawDataPtt==$null)
		{
			$pttdata= $null;	
		}
		if($rawDataYoutube!=$null)
		{
			$youtubedata= $rawDataYoutube->paginate(2);
		}
		elseif($rawDataYoutube==$null)
		{
			$youtubedata=$null;

		}
		if($rawDataMobile01!=$null)
		{
			$mobile01data=$rawDataMobile01->paginate(2);
		}
		elseif ($rawDataMobile01==$null) {
			$mobile01data=$null;
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
			,'whoIsTheBestDog'=>$whoIsTheBestDog,'search'=> $search]);
	}



}