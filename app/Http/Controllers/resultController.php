<?php

namespace App\Http\Controllers;
use Illuminate\Routing\Controller as BaseController;

use Illuminate\Pagination\Paginator;
use Illuminate\Pagination\LengthAwarePaginator;
use View;
use App\Pixnet;
use App\Xuite;
use App\Ptt;
use App\Youtube;

use Illuminate\Http\Request;

class resultController extends Controller {
public function index(Request $request)
	{
	$search = $request->input('search');

	//$key_word = $search;
	//$url_key_word=urlencode(mb_convert_encoding($key_word, 'utf-8'));
	//$file1 = popen("start/b C://xampp/htdocs/done/SearchPixnet.py $url_key_word",'r');
	//$file2 = popen("start/b C://xampp/htdocs/done/SearchPtt.py $url_key_word",'r');
	//$file3 = popen("start/b C://xampp/htdocs/done/SearchXuite.py $url_key_word",'r');
	//$file4 = popen("start/b C://xampp/htdocs/done/SearchYoutube.py $url_key_word",'r');
	//pclose($file1);
	//pclose($file2);
	//pclose($file3);
	//pclose($file4);

 	return view('wait',['search'=> $search]);
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
	public function show(Request $request)
	{
	$search = $request->input('search');

	
 	$pixnetdata = Pixnet::where('search_title','like',"%$search%")->paginate(2);
 	$xuitedata = Xuite::where('search_title','like',"%$search%")->paginate(2);
 	$pttdata = Ptt::where('search_title','like',"%$search%")->paginate(2);
 	$youtubedata= Youtube::where('search_title','like',"%$search%")->paginate(2);
 
 	return view('result',['pixnetdata'=>$pixnetdata,
 						'xuitedata'=>$xuitedata,'pttdata'=>$pttdata,
 						'youtubedata'=>$youtubedata,'search'=> $search]);
	}



}