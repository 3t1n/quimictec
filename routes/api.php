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



Route::group(['namespace' => 'api\\'], function () {
    Route::post('user/login','AuthController@login');

    Route::get('user/logout', 'AuthController@logout');
});

Route::middleware('jwt.auth')->group(function(){

    Route::get('token/refresh', 'api\AuthController@refresh');
    Route::get('user/logout', 'api\AuthController@logout');
    Route::get('user/me', 'api\AuthController@me');


      Route::post('rh/recrutamento', 'api\RhController@recrutamento');
});
