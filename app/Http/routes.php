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

/*
$app->get('/', function () use ($app) {
  return home($app);
});
*/

//config(['app.debug' => false]);
$app->get('/', 'Controller@home');
$app->get('/ivr/welcome', ['as' => 'ivr-welcome', 'uses' => 'Controller@ivrWelcome']);
$app->post('/ivr/response', ['as' => 'ivr-response', 'uses' => 'Controller@ivrResponse']);
$app->post('/sms', ['uses' => 'Controller@smsResponse']);


$app->get('/moo', ['as' => 'moo', 'uses' => 'Controller@moo']);
