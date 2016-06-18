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

Route::get('/', ['uses' => 'HomeController@index']);
Route::get('/login', ['uses' => 'Auth\AuthController@getLogin']);
Route::get('/logout', ['uses' => 'Auth\AuthController@getLogout']);
Route::get('/signup', ['uses' => 'Auth\AuthController@getRegister']);
Route::post('/login', ['uses' => 'Auth\AuthController@postLogin']);

Route::get('/mapa', ['uses' => 'HomeController@getMap']);

Route::group(['middleware' => 'auth'], function() {
    Route::get('panel', ['uses' => 'NodeController@index']);
    Route::get('panel/nodos', ['uses' => 'NodeController@index']);
    Route::get('panel/nodos/crear', ['uses' => 'NodeController@create']);
    Route::get('panel/nodos/{id}', ['uses' => 'NodeController@show']);
    Route::get('panel/nodos/{id}/editar', ['uses' => 'NodeController@edit']);

    Route::post('panel/nodos/crear', ['uses' => 'NodeController@store']);
    Route::put('panel/nodos/{id}/editar', ['uses' => 'NodeController@update']);
    Route::delete('panel/nodos/{id}', ['uses' => 'NodeController@destroy']);
});
