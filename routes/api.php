<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['prefix' => 'roles',  'middleware' => 'auth:api'], function() {
    Route::get('', 'RolesController@getAll');
    Route::post('', 'RolesController@create');
    Route::get('/{id}', 'RolesController@getById');
    Route::patch('/{id}', 'RolesController@update');
    Route::delete('/{id}', 'RolesController@delete');

    Route::get('/{id}/permissions', 'RolesController@permissions');
});

Route::group(['prefix' => 'permissions',  'middleware' => 'auth:api'], function() {
    Route::get('', 'PermissionsController@getAll');
    Route::post('', 'PermissionsController@create');
    Route::get('/{id}', 'PermissionsController@getById');
    Route::patch('/{id}', 'PermissionsController@update');
    Route::delete('/{id}', 'PermissionsController@delete');
});