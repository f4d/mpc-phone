<?php

namespace App\Http\Controllers;

use Laravel\Lumen\Routing\Controller as BaseController;

class Controller extends BaseController
{
    //
  public function home() {
	  $msg_id = '9342390942';
	  $url = 'http://petguardian.staging.wpengine.com/wp-json/petguardian/v1/ivr-notification?lookup=';
	  get_headers($url.$msg_id);
		return "Welcome, nerds!!!";  	
  }
  function ivrResponse(Request $request)
	{
		//?Digits=9342390942
	  $msg_id = $request->input('Digits');
	  $url = 'http://petguardian.staging.wpengine.com/wp-json/petguardian/v1/ivr-notification?lookup=';
	  get_headers($url.$msg_id);
		$response->say(
		    "You entered $getId",
		    ['voice' => 'Alice', 'language' => 'en-GB']
		);
		return $response;
	}
}
