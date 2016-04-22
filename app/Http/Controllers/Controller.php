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

	public function ivrWelcome()
	{
		$response = new Services_Twilio_Twiml;
		$say = 'Please enter your 10 digit pet eye dee or owner eye dee.';
		//
		//);
		//$response->play('',['digits' => '0');
		$gather = $response->gather(
		    ['numDigits' => 10,
		    'action' => route('ivr-response', [], false)]
		); 
		$gather->say(
			$say, ['voice' => 'Alice', 'language' => 'en-US']
		/*
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
	  $url = 'http://petguardian.staging.wpengine.com/wp-json/petguardian/v1/ivr-notification';
	  $url .= "?lookup=$lookup";
	  $url .= "&from=$from";
	  get_headers($url);
	  $response = new Services_Twilio_Twiml;
		$say = 'Got it, thanks!';
		$response->say(
		    $say, ['voice' => 'Alice', 'language' => 'en-GB']
		);		
		return $response;
  }	
	public function smsResponse(Request $request) {
	  $lookup = $request->input('Body');
	  $from = $request->input('From');
	  $url = 'http://petguardian.staging.wpengine.com/wp-json/petguardian/v1/sms-notification';
	  $url .= "?lookup=$lookup";
	  $url .= "&from=$from";
	  get_headers($url);
  }
  public function moo(Request $request)
	{
		//?Digits=9342390942
		//?id=9342390942
	  $msg_id = $request->input('id');
	  $url = 'http://petguardian.staging.wpengine.com/wp-json/petguardian/v1/ivr-notification?lookup=';
	  get_headers($url.$msg_id);
	  $response = new Services_Twilio_Twiml;
		$say = 'Got it, thanks!';
		$response->say(
		    $say, ['voice' => 'Alice', 'language' => 'en-GB']
		);		
		return $response;
	}
}
