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

//Route::get('index', 'RequisitosController@pagination');

Route::get('index/{field?}', 'RequisitosController@search');

Route::get('requisito/{id}', 'RequisitosController@details');

Route::post('requisito/modificar', 'RequisitosController@modify');
Route::get('proyectos', 'ProyectosController@search');