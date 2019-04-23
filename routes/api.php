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
    Route::post('user/esqueceu','AuthController@esqueceu_senha');
    Route::post('user/muda_senha','AuthController@muda_senha');
    Route::get('teste',function(){
        $teste = "Teste API";
        return $teste;
    });


    Route::get('user/logout', 'AuthController@logout');
});

Route::middleware('jwt.auth')->group(function(){

    Route::post('ponto','api\PontoController@ponto');
    Route::get('token/refresh', 'api\AuthController@refresh');
    Route::get('user/logout', 'api\AuthController@logout');
    Route::get('user/me', 'api\AuthController@me');


      Route::post('rh/recrutamento', 'api\RhController@recrutamento');
});
