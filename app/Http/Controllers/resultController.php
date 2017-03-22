<?php

namespace App\Http\Controllers;
use Illuminate\Routing\Controller as BaseController;
use View;



class resultController extends Controller {
public function index()
{
 return View::make('result');

}

}