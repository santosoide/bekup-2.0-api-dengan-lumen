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

$app->post('login', function(Request $request, JWTAuth $jwt) {
    
});

$app->post('auth/login',['as' => 'user.store','uses' => 'UserController@postLogin']);

$app->group(['middleware' => 'auth', 'namespace' => 'App\Http\Controllers'], function () use ($app) {
    $app->post('user-jwt',['as' => 'user.jwt','uses' => 'UserController@token']);
    $app->get('user',['as' => 'user.index','uses' => 'UserController@index']);
    $app->post('user',['as' => 'user.store','uses' => 'UserController@store']);
    $app->get('user/{id}',['as' => 'user.show','uses' => 'UserController@show']);
    $app->put('user/{id}',['as' => 'user.update','uses' => 'UserController@update']);
    $app->delete('user/{id}',['as' => 'user.destroy','uses' => 'UserController@destroy']);
});

$app->get('user-list',['as' => 'user.index','uses' => 'UserController@index']);