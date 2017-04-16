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
    return redirect('users');
    //return view('welcome');
});

Route::get('/home', function () {
    return view('public/home');
});
Route::get('/proyecto', function () {
    return view('public/proyecto');
});
Route::get('/contacto', function () {
    return view('public/contacto');
});
//Route::get('index', 'RequisitosController@pagination');

Route::get('hola', function(){ return view('prueba'); });
Route::get('hola2', 'UserController@gith');

Route::get('index/{field?}', 'RequisitosController@search');

// Listados de objetos relacionales
Route::get('users', 'UserController@search');
Route::get('proyectos', 'ProyectosController@search');
Route::get('sprints', 'SprintController@search');
Route::get('requisitos', 'RequisitosController@search');
Route::get('rols', 'RolController@search');
Route::get('permisos', 'PermisoController@search');
//Route::get('proyectosusers', 'ProyectoUserController@search');

// Formularios de creación de objetos relacionales
Route::get('proyecto/new', function(){ return view('proyecto_new'); });
Route::get('sprint/new', 'SprintController@getProyectos');
Route::get('user/new', function(){ return view('user_new'); });
Route::get('requisito/new', 'RequisitosController@getSprints');
Route::get('rol/new', function(){ return view('rol_new'); });
Route::get('permiso/new', function(){ return view('permiso_new'); });


// Inserción de nuevos objetos relacionales
Route::post('proyecto/create', 'ProyectosController@create');
Route::post('sprint/create', 'SprintController@create');
Route::post('requisito/create', 'RequisitosController@create');
Route::post('rol/create', 'RolController@create');
Route::post('user/create', 'UserController@create');
Route::post('permiso/create', 'PermisoController@create');

// Detallado de objetos relacionales
Route::get('proyecto/{id}', 'ProyectosController@details');
Route::get('sprint/{id}', 'SprintController@details');
Route::get('requisito/{id}', 'RequisitosController@details');
Route::get('user/{id}', 'UserController@details');
Route::get('rol/{id}', 'RolController@details');
Route::get('permiso/{id}', 'PermisoController@details');

// Borrado de objetos relacionales
Route::get('requisito/borrar/{id}', 'RequisitosController@delete');
Route::get('proyecto/borrar/{id}', 'ProyectosController@delete');
Route::get('sprint/borrar/{id}', 'SprintController@delete');
Route::get('user/borrar/{id}', 'UserController@delete');
Route::get('rol/borrar/{id}', 'RolController@delete');
Route::get('permiso/borrar/{id}', 'PermisoController@delete');

// Modificado de objetos relacionales
Route::post('requisito/modificar', 'RequisitosController@modify');
Route::post('proyecto/modificar', 'ProyectosController@modify');
Route::post('sprint/modificar', 'SprintController@modify');
Route::post('user/modificar', 'UserController@modify');
Route::post('rol/modificar', 'RolController@modify');
Route::post('permiso/modificar', 'PermisoController@modify');

// Filtrado de listado
/*Route::post('proyectos', 'ProyectosController@filtrar');
Route::post('sprints', 'SprintController@filtrar');
Route::post('users', 'UserController@filtrar');
Route::post('rols', 'RolController@filtrar');
Route::post('requisitos', 'RequisitosController@filtrar');*/
Auth::routes();

//Route::get('/home', 'HomeController@index');
