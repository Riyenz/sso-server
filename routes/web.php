<?php

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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::group(['prefix' => 'users',  'middleware' => 'auth:web'], function() {
    Route::get('', 'UsersController@getAll');
    Route::post('', 'UsersController@create');
    Route::get('/{id}', 'UsersController@getById');
    Route::patch('/{id}', 'UsersController@update');
    Route::delete('/{id}', 'UsersController@delete');
});


Route::group(['prefix' => 'roles',  'middleware' => 'auth:web'], function() {
    Route::get('', 'RolesController@getAll');
    Route::post('', 'RolesController@create');
    Route::get('/{id}', 'RolesController@getById');
    Route::patch('/{id}', 'RolesController@update');
    Route::delete('/{id}', 'RolesController@delete');
    
    Route::get('/{id}/permissions', 'RolesController@permissions');
});

Route::group(['prefix' => 'permissions',  'middleware' => 'auth:web'], function() {
    Route::get('', 'PermissionsController@getAll');
    Route::post('', 'PermissionsController@create');
    Route::get('/{id}', 'PermissionsController@getById');
    Route::patch('/{id}', 'PermissionsController@update');
    Route::delete('/{id}', 'PermissionsController@delete');
});
