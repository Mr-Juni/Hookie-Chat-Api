<?php

use App\Events\UserSignedUp;
use Illuminate\Support\Facades\Redis;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });
//1. Publish event width Redis
//2. Node.js - Redis subscribes to the event
//3. Use Socket.io to emit all to client
Route::get('/', function () {

	// $data = [
	// 	'event' => 'UserSignedUp',
	// 	'data' => [
	// 		'username' => 'Okechukwu David',
	// 		'role' => 'Software Programmer'
	// 	]

	// ];

 //   Redis::publish('test-channel', json_encode($data));

   event(new UserSignedUp(Request::query('name'),Request::query('role'), Request::query('age')));
   return view('welcome');
});
