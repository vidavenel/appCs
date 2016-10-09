<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/
Route::get('/ip', 'IpController@store');

Route::group(['middleware' => 'auth'], function () {
    Route::get('/', 'SmsController@create');
    Route::resource('sms', 'SmsController');
    Route::resource('groupe', 'GroupeController');
});

Route::group(['middleware' => ['auth', 'can:admin']], function () {
    Route::resource('agent', 'AgentController');
    Route::resource('user', 'UserController');
    Route::get('/configuration', 'ConfigurationController@index');
    Route::post('/configuration', 'ConfigurationController@update');
});

Auth::routes();
Route::get('confirm/{id}/{token}', 'Auth\RegisterController@confirm');

Route::get('/home', 'HomeController@index');
