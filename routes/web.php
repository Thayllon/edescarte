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

Route::get('/', 'LojasController@index');

Route::resource('lojas', 'LojasController');

Route::post('lojas/buscar', 'LojasController@buscar');

Route::get('/adicionar-farmacia', 'LojasController@create');

Route::post('lojas/{$id}/editar', 'LojasController@edit');

Auth::routes();


