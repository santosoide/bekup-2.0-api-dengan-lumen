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
    return $app->version();
});

$app->get('user',['as' => 'user.index','uses' => 'UserController@index']);
$app->post('user',['as' => 'user.store','uses' => 'UserController@store']);
$app->get('user/{id}',['as' => 'user.show','uses' => 'UserController@show']);
$app->put('user/{id}',['as' => 'user.update','uses' => 'UserController@update']);
$app->delete('user/{id}',['as' => 'user.destroy','uses' => 'UserController@destroy']);
