<?php

namespace App\Http\Controllers;
use Illuminate\Routing\Controller as BaseController;
use View;



class sampleController extends Controller {
public function index()
{
 return View::make('sample');

}

}