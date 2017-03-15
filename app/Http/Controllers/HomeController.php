<?php

namespace App\Http\Controllers;
use Illuminate\Routing\Controller as BaseController;
use View;



class HomeController extends Controller {
public function index()
{
return View::make('home')
->with('title', '首頁')
->with('hello', '大家好～～');
}
}