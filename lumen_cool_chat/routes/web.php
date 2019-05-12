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

$router->get('/', function () use ($router) {
    return $router->app->version();
});

$router->post('api/name', 'NameController@store');
$router->post('api/continue/chat', 'NameController@continue');
$router->post('api/message', 'GroupMessageController@store');
$router->get('api/all/members', 'MembersController@index');
$router->get('api/group/messages', 'GroupMessageController@groupMessagesIndex');
$router->post('api/group/messages/scroll/load', 'GroupMessageController@groupMessages');