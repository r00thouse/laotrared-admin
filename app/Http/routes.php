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
Route::post('/login', ['uses' => 'Auth\AuthController@postLogin']);
Route::get('/logout', ['uses' => 'Auth\AuthController@logout']);

Route::get('/signup', ['uses' => 'Auth\AuthController@getRegister']);
Route::post('signup', ['uses' => 'Auth\AuthController@postRegister']);

Route::get('/nodos', ['uses' => 'NodeController@all']);

Route::group(['middleware' => 'auth'], function() {
    Route::group(['middleware' => ['permission:read_network']], function() {
        Route::get('panel/redes', ['uses' => 'NetworkController@index']);
        Route::get('panel/redes/crear', ['uses' => 'NetworkController@create']);
        Route::get('panel/redes/{id}/editar', ['uses' => 'NetworkController@edit']);
    });

    Route::post('panel/redes/crear', ['uses' => 'NetworkController@store', 'middleware' => ['permission:create_network']]);
    Route::put('panel/redes/{id}/editar', ['uses' => 'NetworkController@update', 'middleware' => ['permission:update_network']]);
    Route::delete('panel/redes/{id}', ['uses' => 'NetworkController@destroy', 'middleware' => ['permission:delete_network']]);
});

Route::group(['middleware' => 'auth'], function() {
    Route::group(['middleware' => ['permission:read_node']], function() {
        Route::get('panel', ['uses' => 'NodeController@index']);
        Route::get('panel/nodos', ['uses' => 'NodeController@index']);
        Route::get('panel/nodos/crear', ['uses' => 'NodeController@create']);
        Route::get('panel/nodos/{id}', ['uses' => 'NodeController@show']);
        Route::get('panel/nodos/{id}/editar', ['uses' => 'NodeController@edit']);
    });

    Route::post('panel/nodos/crear', ['uses' => 'NodeController@store', 'middleware' => ['permission:create_node']]);
    Route::put('panel/nodos/{id}/editar', ['uses' => 'NodeController@update', 'middleware' => ['permission:update_node']]);
    Route::delete('panel/nodos/{id}', ['uses' => 'NodeController@destroy', 'middleware' => ['permission:delete_node']]);
});
