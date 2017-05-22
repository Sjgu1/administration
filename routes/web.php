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





//--------------Rutas de acceso publicas---------------------//
Route::get('/home', function () {
    return view('public/home');
});
Route::get('/admin', function () {
    return view('public/pruebaAdmin');
});
Route::get('/proyecto', function () {
    return view('public/proyecto');
});
Route::get('/contacto', function () {
    return view('public/contacto');
});
Route::get('/', function () {
    return redirect('home');
});
Route::post('/contacto', 'ContactoController@contacto');
//------------------------------------------------------------//




//Route::get('index', 'RequisitosController@pagination');

//Route::get('hola', function(){ return view('prueba'); });
//Route::get('hola2', 'UserController@gith');




//Usuario. Ahora todas las rutas se encuentran dentro del middleware web, para que la traducción funcione correctamente
Route::get('lang/{lang}', function($lang){

    session(['lang' => $lang]);

    return \Redirect::back();
    
})->where(['lang' => 'en|es']);

// poner 'auth' para que obligue a los usuarios estar conectados, poner en los controladores el constructor de auth (mirar requisitosController)
Route::group(['middleware' => ['web', 'auth']], function(){

    //Parte administrador
    Route::get('index/{field?}', 'RequisitosController@search');//Devuelve lista de requisitos

    Route::get('user/proyectosusers', 'InsideController@searchProyecto');
    Route::get('user/proyecto/new', 'ProyectosController@vistaCreate');
    Route::post('user/proyecto/create', 'InsideController@createProyecto');
    Route::get('user/requisito/new', function(){ return view('user.requisitonew'); });
    Route::post('user/requisito/create', 'InsideController@createRequisito');
    Route::get('user/requisitosusers', 'InsideController@searchRequisito');
    Route::get('user/sprintsusers', 'InsideController@searchSprint');

    Route::post('setSession', 'InsideController@setSession');
    Route::get('actividad', 'ProyectosController@actividad');
    Route::get('graficos/burndown/sprints', 'ProyectosController@burndown_sprints');
    Route::get('graficos/commits', 'ProyectosController@graficos_commits');
    Route::get('graficos/requisitos', 'ProyectosController@graficos_requisitos');
    Route::get('graficos/frecuenciadia', 'ProyectosController@graficos_frecuencia_dia');
    Route::get('graficos/frecuenciahora', 'ProyectosController@graficos_frecuencia_hora');
    Route::get('userspublic', 'ProyectoUserController@userspublic')->name('userspublic');
    Route::get('sprintsrequisitos/{sprint_id}/{requisito_id?}', 'SprintController@sprintsrequisitos');
    Route::get('calendario', 'ProyectosController@calendario');

    Route::get('pizarra/{id}', 'SprintController@pizarra');
    Route::post('pizarra', 'RequisitosController@cambiarEstado');
    Route::post('/requisitoUsuario', 'RequisitoUserController@modificarAsignaciones');

    Route::get('user/{id}', 'UserController@sayHello');
    Route::get('/profile/{id}', 'UserController@details');

    Route::get('perfil', 'UserController@details2');

    Route::post('proyectousercrear', 'ProyectoUserController@create');
    Route::post('proyectouser/modificar', 'ProyectoUserController@modify');
    Route::get('deleteproyectouser/{proyecto_id}/{user_id}', 'ProyectoUserController@delete');

    Route::post('requisito/modificar_public', 'RequisitosController@modify_public');

    Route::get('lang/{lang}', function($lang){

        session(['lang' => $lang]);

        return \Redirect::back();
    
    })->where(['lang' => 'en|es']);

});


//agregar admin

Route::group(['middleware' => ['web', 'auth']], function(){

    //Parte administrador
    Route::get('index/{field?}', 'RequisitosController@search');//Devuelve lista de requisitos
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


Route::post('requisitoUsuario/colores', 'SprintController@modificarColores');
Route::post('requisitoUsuario/colorRequisito', 'RequisitosController@modificarColores');



// Filtrado de listado
/*Route::post('proyectos', 'ProyectosController@filtrar');
Route::post('sprints', 'SprintController@filtrar');
Route::post('users', 'UserController@filtrar');
Route::post('rols', 'RolController@filtrar');
Route::post('requisitos', 'RequisitosController@filtrar');*/
});
Auth::routes();