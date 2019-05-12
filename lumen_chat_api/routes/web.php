<?php
use Illuminate\Support\Facades\Redis;
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

$router->get('/', function () use ($router) {

	// $data = [
	// 	'event' => 'UserSignedUp',
	// 	'data' => [
	// 		'username' => 'Okechukwu David',
	// 		'role' => 'Software Programmer'
	// 	]

	// ];

 //   Redis::publish('test-channel', json_encode($data));

	Redis::set('foo', 'bar');

	return Redis::get('foo');

    // return $router->app->version();
});


