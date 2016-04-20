<?php

namespace App\Http\Controllers;

use Laravel\Lumen\Routing\Controller as BaseController;
use Request;

class Controller extends BaseController
{
  public function home() 
  {
	  $msg_id = '9342390942';
	  $url = 'http://petguardian.staging.wpengine.com/wp-json/petguardian/v1/ivr-notification?lookup=';
	  get_headers($url.$msg_id);
		return "Welcome, nerds!!!";  	
  }
  //public function ivrResponse(Request $request)
  public function ivrResponse()
	{
		//?Digits=9342390942
	  //$msg_id = $request->input('Digits');
	  $msg_id = '9342390942';
	  $url = 'http://petguardian.staging.wpengine.com/wp-json/petguardian/v1/ivr-notification?lookup=';
	  get_headers($url.$msg_id);
	  $response = new Services_Twilio_Twiml;
		$response->say(
		    "Got it, thanks!",
		    ['voice' => 'Alice', 'language' => 'en-GB']
		);
		return $response;
	}
}
