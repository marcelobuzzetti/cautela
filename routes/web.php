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
    return view('inicio');
});
/*Materiais*/
Route::get('/materiais', 'MaterialController@lista');

Route::get('/materiais/novo', 'MaterialController@novo');

Route::post('/materiais/adiciona', 'MaterialController@adiciona');

Route::get('/materiais/altera/{id}', 'MaterialController@altera')->where('id','[0-9]+');

Route::post('/materiais/apaga', 'MaterialController@apaga');

/*Militares*/
Route::get('/militares', 'MilitarController@lista');

Route::get('/militares/novo', 'MilitarController@novo');

Route::post('/militares/adiciona', 'MilitarController@adiciona');

Route::post('/militares/adicionacautela', 'MilitarController@adicionacautela');

Route::get('/militares/altera/{id}', 'MilitarController@altera')->where('id','[0-9]+');

Route::post('/militares/apaga', 'MilitarController@apaga');

/*Pelotões*/
Route::get('/pelotoes', 'PelotaoController@lista');

Route::get('/pelotoes/novo', 'PelotaoController@novo');

Route::post('/pelotoes/adiciona', 'PelotaoController@adiciona');

Route::get('/pelotoes/altera/{id}', 'PelotaoController@altera')->where('id','[0-9]+');

Route::post('/pelotoes/apaga', 'PelotaoController@apaga');

Route::get('/militar/pelotao', 'PelotaoController@autocomplete');

/*Cautela*/
Route::get('/cautelas', 'CautelaController@lista');

Route::get('/cautelas/novo', 'CautelaController@novo');

Route::post('/cautelas/adiciona', 'CautelaController@adiciona');

Route::post('/cautelas/encerra', 'CautelaController@encerra');

Route::post('/cautelas/apaga', 'CautelaController@apaga');

Route::post('/cautelas/detalhes', 'CautelaController@detalhes');

/*Cautelar Material*/
Route::post('/cautelamaterial', 'CautelaMaterialController@novo');

Route::post('/cautelamaterial/adiciona', 'CautelaMaterialController@adiciona');

Route::post('/cautelamaterial/entrega', 'CautelaMaterialController@entrega');

Route::get('/cautelamaterial/maximo/id={material}', 'CautelaMaterialController@maximo')->where('material','[0-9]+');

/*Registrar Usuários*/
Route::get('/registrar', 'RegistroController@novo');

Route::post('/registrar/novo', 'RegistroController@adiciona');

/*Usuários*/
Route::get('/usuarios/lista', 'UsuarioController@lista');

Route::post('/usuarios/apaga', 'UsuarioController@apaga');

Route::post('/usuarios/ativa', 'UsuarioController@ativar');

Route::get('/usuarios/altera/{id}', 'UsuarioController@altera')->where('id','[0-9]+');

Route::post('/usuarios/atualiza', 'UsuarioController@atualiza');

Route::post('/usuarios/reset', 'UsuarioController@reset');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
