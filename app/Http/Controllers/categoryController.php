<?php
namespace App\Http\Controllers;
use Illuminate\Routing\Controller as BaseController;
use View;
use App\Pixnet;
use Illuminate\Http\Request;



class categoryController extends Controller {
	public function index(){
		$pixnetdata = Pixnet::orderBy('search_time', 'desc')->paginate(6); 
		return view('category',['pixnetdata'=>$pixnetdata]); 
							}


												}