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
Route::get('/fornecedores', 'fornecedores@index')->name('fornecedores');
Route::post('/fornecedores/registrar', 'fornecedores@registrar')->name('regFornecedores');
Route::get('/funcionarios/status/{id}', 'funcionarios@status');
Route::get('/estoque', 'estoqueController@index')->name('estoque');
Route::post('/estoque/registrar', 'estoqueController@registrar')->name('regEstoque');
Route::get('/estoque/editar/{id}', 'estoqueController@editar')->name('edtEstoque');
Route::delete('/estoque/deletar/{id}', 'estoqueController@deletar')->name('delEstoque');
