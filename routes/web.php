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
Route::group(['middleware' => ['auth']], function() {
    Route::get('/home', 'HomeController@index')->name('home');

    Route::group(['middleware' => ['roles'], 'roles' => ['administrator'] ], function() {
        Route::get('/controle_ponto', 'controle_ponto@index')->name('controle_ponto');
        Route::get('/home_office', 'home_office@index')->name('home_office');
        Route::get('/home_office/status/{id}', 'home_office@status');
        Route::delete('/home_office/delete/{id}', 'home_office@deletar')->name('delHome');
        Route::get('/funcionarios', 'funcionarios@index')->name('funcionarios');
        Route::post('/funcionarios/registrar', 'funcionarios@registrar')->name('regFuncionarios');
        Route::delete('/funcionarios/deletar/{id}', 'funcionarios@deletar')->name('delFuncionarios');
        Route::get('/funcionarios/status/{id}', 'funcionarios@status');
        Route::get('/fornecedores', 'fornecedores@index')->name('fornecedores');
        Route::post('/fornecedores/registrar', 'fornecedores@registrar')->name('regFornecedores');
    });
    Route::get('/atividades_externas', 'AtividadesExternas@index')->name('atividades_externas');
    Route::get('/estoque', 'estoqueController@index')->name('estoque');
    Route::post('/estoque/registrar', 'estoqueController@registrar')->name('regEstoque');
//Route::PUT('/estoque/editar/{id}', 'estoqueController@editar')->name('edtEstoque');
    Route::delete('/estoque/deletar/{id}', 'estoqueController@deletar')->name('delEstoque');
});
