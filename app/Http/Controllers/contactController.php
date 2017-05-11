<?php
namespace App\Http\Controllers;
use Illuminate\Routing\Controller as BaseController;
use View;
use App\Mail;
use Illuminate\Http\Request;

class contactController extends Controller {
	public function index()
	{
		
        return view('contact');
	
	}

	public function contact(Request $request)
	{
		$this->middleware('auth');
		$id =Mail::insertGetId(
    		array('problem' => $request->problem, 
    			'contact_name' =>$request->contact_name,
    			'contact_mail' =>$request->contact_mail,
    			'contact_number' => $request->contact_number,
    			'contact_message' => $request->contact_message,
    			
    			)
		);

		

        return view('contact')->with('success','已送出回報');
	
	}
}