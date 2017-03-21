<?php

namespace App\Http\Controllers;
use Illuminate\Routing\Controller as BaseController;
use View;



class showController extends Controller {
public function index()
{
 return View::make('show');

}

}