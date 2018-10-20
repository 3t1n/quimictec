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
//func de index
Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/funcionarios', 'funcionarios@index')->name('funcionarios');
Route::get('/controle_ponto', 'controle_ponto@index')->name('controle_ponto');
Route::post('/funcionarios/registrar', 'funcionarios@registrar')->name('regFuncionarios');
