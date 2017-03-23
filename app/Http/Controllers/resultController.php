<?php

namespace App\Http\Controllers;
use Illuminate\Routing\Controller as BaseController;
use View;
use App\Pixnet;


class resultController extends Controller {
public function index()
{
	$data=Pixnet::all();

    return view('result',['data'=>$data]);
}

}