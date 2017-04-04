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
if(($search)!=null)
 {
 	$resultdata = Pixnet::where('title','like',"%$search%")->paginate(5);
	if(count($resultdata)>0)
    	return view('result',['resultdata'=>$resultdata],['search'=> $search]);
	else 
		return view('index');
 }

else	
	{
		return view('index');
	}
}

}