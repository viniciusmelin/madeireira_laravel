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
Route::get('/admin/painel', 'HomeController@index')->name('home');

Route::prefix('admin')->group(function(){
    Route::prefix('cliente')->group(function()
    {
        Route::get('visualizar/{id}', 'ClientController@show')->name('cliente.visualizar');
        Route::get('cadastrar', 'ClientController@create')->name('cliente.cadastrar');
        Route::post('salvar', 'ClientController@store')->name('cliente.salvar');
        Route::get('clientejson', 'ClientController@getPesqClient')->name('cliente.json');

        Route::prefix('telefone')->group(function () {
            
            Route::post('salvar', 'PhoneController@store')->name('phone.salvar');
            Route::post('remover', 'PhoneController@destroy')->name('phone.remover');
            Route::post('atualizar', 'PhoneController@update')->name('phone.atualizar');
            Route::get('getPhoneJson', 'PhoneController@getPhoneJson')->name('phone.getjson');
        });

        Route::prefix('endereco')->group(function () {

            Route::post('salvar','AddressController@store')->name('address.salvar');
            Route::post('atualizar','AddressController@update')->name('address.atualizar');
            Route::post('remover','AddressController@destroy')->name('address.remover');
        });

        Route::prefix('email')->group(function () {

            Route::post('salvar','EmailController@store')->name('email.salvar');
            Route::post('atualizar','EmailController@update')->name('email.atualizar');
            Route::post('remover','EmailController@destroy')->name('email.remover');
        });

    });

    Route::prefix('clientes')->group(function(){

        Route::get('visualizar/{id}', 'ClientController@show')->name('cliente.visualizar');
        Route::get('', 'ClientController@index')->name('cliente.inicial');
        Route::get('getJson', 'ClientController@getJson');
    });


    Route::prefix('produtos')->group(function(){

        Route::get('', 'ProductController@index')->name('produto.inicial');
        Route::get('cadastrar', 'ProductController@create')->name('produto.cadastrar');
        Route::post('salvar', 'ProductController@store')->name('produto.salvar');
        Route::get('editar/{id}', 'ProductController@edit')->where(['id'=>'[0-9]'])->name('produto.editar');
        Route::post('atualizar', 'ProductController@update')->name('produto.atualizar');
    });
    Route::prefix('produto')->group(function () {
        Route::get('produtojson', 'ProductController@getJsonProduct')->name('produto.json');
    });
        

    Route::prefix('pedidos')->group(function(){

        Route::get('', 'OrderController@index')->name('pedido.inicial');
        Route::get('cadastrar', 'OrderController@create')->name('pedido.cadastrar');
        Route::post('salvar', 'OrderController@store')->name('pedido.salvar');
    });

    Route::prefix('pedido')->group(function()
    {
        Route::get('atualizar/{id}', 'OrderController@edit')->name('pedido.editar');
        Route::post('removeritem', 'OrderController@removerItem')->name('pedido.removerItem');
        Route::post('alterarsituacao', 'OrderController@update')->name('pedido.situacao');
    });

    Route::prefix('vendedor')->group(function () {

        Route::get('cadastrar', 'SalesmanController@create')->name('vendedor.cadastrar');
        Route::post('salvar', 'SalesmanController@store')->name('vendedor.salvar');
        Route::get('visualizar/{id}', 'SalesmanController@show')->name('vendedor.visualizar');
        Route::get('vendendorjson', 'SalesmanController@getJson')->name('vendedor.json');
    });

    Route::prefix('vendedores')->group(function(){
        Route::get('', 'SalesmanController@index')->name('vendedor.inicial');
    });

    Route::prefix('receber')->group(function()
    {
        Route::get('','AccountReciveController@index')->name('receber.inicial');
        Route::get('cadastrar','AccountReciveController@create')->name('receber.cadastrar');
    });

});
