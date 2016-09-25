<?php

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


Route::get('/ip', 'IpController@store');
Route::auth();

Route::get('/home', 'HomeController@index');

Route::group(['middleware' => 'auth'], function () {
    Route::get('/', 'SmsController@create');
    Route::get('/sms/create', 'SmsController@create');
    Route::post('/sms', 'SmsController@store');
    Route::get('/groupe/{id}', 'GroupeController@show');
});
Route::group(['middleware' => ['auth', 'can:admin']], function () {
    Route::resource('sms', 'SmsController');
    Route::resource('agent', 'AgentController');
    Route::resource('groupe', 'GroupeController');
    Route::resource('user', 'UserController');
});