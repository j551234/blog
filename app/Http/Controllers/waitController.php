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

class waitController extends Controller {
public function index(Request $request)
	{


 		return view('wait',['search'=> $search]);
	}
