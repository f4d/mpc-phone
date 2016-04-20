<?php

namespace App\Http\Controllers;
use Laravel\Lumen\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use App\Http\Requests;
use Services_Twilio_Twiml;

class Controller extends BaseController
{
  public function home() 
  {
	  $msg_id = '9342390942';
	  $url = 'http://petguardian.staging.wpengine.com/wp-json/petguardian/v1/ivr-notification?lookup=';
	  get_headers($url.$msg_id);
		return "Welcome, nerds!!!";  	
  }
  public function ivrResponse(Request $request) {

  }
  public function moo(Request $request)
	{
		//?Digits=9342390942
		//?id=9342390942
	  $msg_id = $request->input('id');
	  //$msg_id = '9342390942';
	  $url = 'http://petguardian.staging.wpengine.com/wp-json/petguardian/v1/ivr-notification?lookup=';
	  get_headers($url.$msg_id);
		  	
		
	  $response = new Services_Twilio_Twiml;

		$say = 'Got it, thanks!';
		/*
		$response->say(
		    $say, ['voice' => 'Alice', 'language' => 'en-GB']
		);
		*/
		//return $response;
		return $url.$msg_id;
	}
}
