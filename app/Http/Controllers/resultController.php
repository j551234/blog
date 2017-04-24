<?php

namespace App\Http\Controllers;
use Illuminate\Routing\Controller as BaseController;
use View;
use App\Pixnet;
use Illuminate\Http\Request;

class resultController extends Controller {
public function index(Request $request)
	{
	  
      

	$search = $request->input('search');
 	$resultdata = Pixnet::where('search_title','like',"%$search%")
 	->paginate(5);
	return view('result',['resultdata'=>$resultdata],['search'=> $search]);
	}
	public function score(Request $request)
	{
		// echo $request->id;
		$value = (int)$request->currentRating;
		$scorepeople=pixnet::where('id',$request->id)
          				->increment('score_people');
		$scorepeople=pixnet::where('id',$request->id)
          				->increment('total_score',$value);
      

   //      $search = $request->input('search');
 		// $resultdata = Pixnet::where('search_title','like',"%$search%")
 		// ->paginate(5);
        $resultdata = pixnet::find($request->id);
		return $resultdata->toJson();
	}



}