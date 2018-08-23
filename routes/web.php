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
    return view('index');
});

Route::group(['prefix'=> 'ithappens'], function () {

    Route::resource('pedidos', 'PedidoController');
    Route::get('pedidos/view/{id}', 'PedidoController@view');
    Route::get('pedidos/adicionarproduto/{id}', 'PedidoController@addProduct');
    Route::post('pedidos/adicionarproduto', 'PedidoController@storeProduct');

});
