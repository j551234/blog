<?php
namespace App\Http\Controllers;
use Illuminate\Routing\Controller as BaseController;
use View;
use App\Pixnet;


class contactController extends Controller {
	public function contact()
	{
		return view('contact');
	}
}