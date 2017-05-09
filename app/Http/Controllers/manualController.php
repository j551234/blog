<?php

namespace App\Http\Controllers;
use Illuminate\Routing\Controller as BaseController;
use View;

class manualController extends Controller {
	public function index()
	{
		
        return view('manual');
	
	}
}