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
use App\Mobile01;

use Illuminate\Http\Request;

class waitController extends Controller {
public function index(Request $request)
	{
		
		$search = $request->input('search');

		$searchtype = $request->input('searchtype');
		$searchweb = $request->input('searchweb');
			if(count($searchweb)>=2)
		{
			$searchweb=implode(",",$searchweb);
		
		}



	


 		return view('wait',['search'=> $search,'searchtype'=>$searchtype,'searchweb'=>$searchweb]);
	}
