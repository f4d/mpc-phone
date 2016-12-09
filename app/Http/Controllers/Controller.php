<?php

namespace App\Http\Controllers;
use Laravel\Lumen\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use App\Http\Requests;
use Services_Twilio_Twiml;
use Log;

class Controller extends BaseController
{
  public function home() 
  {
  	return 'hello';
	  //$msg_id = '9342390942';
	  //$url = 'http://www.millionpetchallenge.com/wp-json/petguardian/v1/ivr-notification?lookup=';
	  //$gh = get_headers($url.$msg_id);
 	  //$log = 'test page response: '.$gh[0];
 	  //error_log($log);
		//return $log;  	
  }

	public function ivrWelcome()
	{
		$response = new Services_Twilio_Twiml;
		$response->play("https://mpc-phone.herokuapp.com/mpc-welcome.mp3", ['loop' => 1]);
		$gather = $response->gather(
		    ['numDigits' => 10,
		    'action' => route('ivr-response', [], false)]
		); 

		/*
		$response->play('',['digits' => '0');
		$gather->play(
		    'http://howtodocs.s3.amazonaws.com/et-phone.mp3',
		    ['loop' => 3]
		);
		*/
		return $response;
	}

  public function ivrResponse(Request $request) {
	  $lookup = $request->input('Digits');
	  $from = $request->input('From');
	  
	  $url = 'http://www.millionpetchallenge.com/wp-json/petguardian/v1/ivr-notification';
	  $url .= "?lookup=$lookup";
	  $url .= "&from=$from";
	  $gh = get_headers($url);
		/*
 	  $log = 'IVR WP Response: '.$gh[0];
 	  //error_log($log);
		*/

		/*
		$say = 'Got it, thanks!';
		$response->say(
		    $say, ['voice' => 'alice', 'language' => 'en-US']
		);		
		*/
 	  $response = new Services_Twilio_Twiml;
 		$response->play("https://mpc-phone.herokuapp.com/mpc-response.mp3", ['loop' => 1]);
		return $response;
  }	
	public function smsResponse(Request $request) {
	  $lookup = $request->input('Body');
	  $from = $request->input('From');
	  $url = 'http://www.millionpetchallenge.com/wp-json/petguardian/v1/sms-notification';
	  $url .= "?lookup=$lookup";
	  $url .= "&from=$from";
	  $gh = get_headers($url);
 	  $log = 'SMS WP Response: '.$gh[0];
 	  error_log($log);
  }
  public function moo(Request $request)
	{
		//?Digits=9342390942
		//?id=9342390942
	  $msg_id = $request->input('id');
	  $url = 'http://www.millionpetchallenge.com/wp-json/petguardian/v1/ivr-notification?lookup=';
		$gh = get_headers($url.$msg_id);
 	  $log = 'test page response: '.$gh[0];
 	  error_log($log);
	  $response = new Services_Twilio_Twiml;
		$say = 'Got it, thanks!';
		$response->say(
		    $say, ['voice' => 'alice', 'language' => 'en-US']
		);		
		return $response;
	}
}
