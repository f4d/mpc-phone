<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

$app->get('/', function () use ($app) {
  return home($app);
});
$app->get('ivr/welcome', ['as' => 'ivr-welcome', function () {
	return ivrWelcome();
}]);
$app->get('ivr/response', ['as' => 'ivr-response', function () use ($app) {
	return ivrResponse($app);
}]);

function home($app) {
  $msg_id = '9342390942';
  $url = 'http://petguardian.staging.wpengine.com/wp-json/petguardian/v1/ivr-notification?lookup=';
  get_headers($url.$msg_id);
	return $app->version()." Welcome, nerds!!!";
}

function ivrWelcome()
{
	$response = new Services_Twilio_Twiml;
	$gather = $response->gather(
	    ['numDigits' => 10,
	     'action' => route('ivr-response', [], false)]
	);
	$say = 'Welcome to the motherfucking mothership. ';
	$say .= 'Please enter your 10 digit pet eye dee or owner eye dee.';
	$response->say(
	    $say, ['voice' => 'Alice', 'language' => 'en-GB']
	);
	/*
	$gather->play(
	    'http://howtodocs.s3.amazonaws.com/et-phone.mp3',
	    ['loop' => 3]
	);
	*/
	return $response;
}

function ivrResponse(Request $request)
{
  $msg_id = $request->input('Digits');
  $url = 'http://petguardian.staging.wpengine.com/wp-json/petguardian/v1/ivr-notification?lookup=';
  get_headers($url.$msg_id);
	$response->say(
	    "You entered $getId",
	    ['voice' => 'Alice', 'language' => 'en-GB']
	);
	return $response;
}