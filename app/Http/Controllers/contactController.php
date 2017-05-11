<?php
namespace App\Http\Controllers;
use Illuminate\Routing\Controller as BaseController;
use View;
use Illuminate\Http\Request;
use Illuminate\Notifications\Messages\MailMessage;
use App\Feedback;
use Mail;


class contactController extends Controller {
	public function index()
	{
		
        return view('contact');
	

	}
	public function contact(Request $request)
	{
		$this->middleware('auth');
		$id =Feedback::insertGetId(
    		array('problem' => $request->problem, 
    			'contact_name' =>$request->contact_name,
    			'contact_mail' =>$request->contact_mail,
    			'contact_number' => $request->contact_number,
    			'contact_message' => $request->contact_message,
    			
    			)

		);
		$request=["$request->problem","$request->contact_name","$request->contact_mail","$request->contact_number"," $request->contact_message"];

<<<<<<< HEAD
		ini_set("SMTP","localhost");
   		ini_set("smtp_port","25");
  		ini_set("sendmail_from","owenpeng19960704@gmail.com");
   	
	  	Mail::send('contact', $request, function ($message) use ($request) {
                $message->to($request[2], $request[1])->subject('已收到回應 我們會盡快回復');
        });
       
		// mail("$request[2]","自動寄信","這裡面是信件內容","from:haha");
        return view('contact');
=======
		

        return view('contact')->with('success','已送出回報');
>>>>>>> 23db0f65324826ef5df0ff8cc4a530c80ebe83d5
	
	}
}