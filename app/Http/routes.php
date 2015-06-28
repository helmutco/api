<?php

use App\Http\Models\User;
/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

$app->get('/', function() use ($app){
	return $app->welcome();
});

$app->get('user/{id}', function($id) use ($app) {
	return User::find($id);
});

$app->get('login', [
    'as' => 'login', 'uses' => 'App\Http\Controllers\UserController@login'
]);

$app->get('checkuser', [
    'as' => 'checkuser', 'uses' => 'App\Http\Controllers\UserController@checkuser'
]);

$app->get('auto', [
    'as' => 'auto', 'uses' => 'App\Http\Controllers\UserController@getauto'
]);