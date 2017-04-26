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
 	$pixnetdata = Pixnet::where('search_title','like',"%$search%")->paginate(2);
 	$xuitedata = Xuite::where('search_title','like',"%$search%")->paginate(2);
 	$pttdata = Ptt::where('search_title','like',"%$search%")->paginate(2);
 	$youtubedata= Youtube::where('search_title','like',"%$search%")->paginate(2);
 // 	$pixnetdata =Pixnet::select('id', 'search_title','search_href','search_author','score_people','total_score')
 // 					->where('search_title','like',"%$search%")
 // 					->get();
 // 	$xuitedata = Xuite::select('id', 'search_title','search_href','search_author','score_people','total_score')
 // 					->where('search_title','like',"%$search%")
 // 					->get();
	// $pttdata = Ptt::select('id', 'search_title','search_href','search_author','score_people','total_score')
 // 					->where('search_title','like',"%$search%")
 // 					->get();
 // 	$alldata= $pixnetdata->union($xuitedata)->union($pttdata);

 	


 

 	return view('result',['pixnetdata'=>$pixnetdata,
 						'xuitedata'=>$xuitedata,'pttdata'=>$pttdata,
 						'youtubedata'=>$youtubedata,'search'=> $search]);
	}
	public function score(Request $request)
	{
		// echo $request->id;
		$value = (int)$request->currentRating;
		$scorepeople=pixnet::where('id',$request->id)
          				->increment('score_people');
		$score=pixnet::where('id',$request->id)
          				->increment('total_score',$value);
        $scorepeople=pixnet::where('id',$request->id)
          				->increment('score_people');
		$score=pixnet::where('id',$request->id)
          				->increment('total_score',$value);
      

   //      $search = $request->input('search');
 		// $resultdata = Pixnet::where('search_title','like',"%$search%")
 		// ->paginate(5);
        $resultdata = pixnet::find($request->id);
		return $resultdata->toJson();
	}



}