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

Route::get('requisito/borrar/{id}', 'RequisitosController@delete');
Route::post('requisito/modificar', 'RequisitosController@modify');

Route::get('proyectos/', 'ProyectosController@search');
Route::get('proyecto/{id}', 'ProyectosController@details');
Route::post('proyecto/modificar', 'ProyectosController@modify');
Route::get('proyecto/borrar/{id}', 'ProyectosController@delete');
Route::post('proyectos', 'ProyectosController@filtrar');