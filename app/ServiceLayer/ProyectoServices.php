<?php

namespace App\ServiceLayer;

use App\Http\Controllers\ProyectosController;
use Illuminate\Support\Facades\DB;
use App\ProyectoUser;
use App\Rol;
use App\User;
use Auth;
use App\Permiso;

class ProyectoServices {

    public static function create(&$request, &$obj){

        $obj->validate($request, [
            'nombre' => ['string', 'min:3', 'max:20'],
            'descripcion' => ['string', 'min:3', 'max:65535'],
            'repositorio' => 'url | nullable',
            'fecha_inicio'=> 'date | required',
            'fecha_fin_estimada'=> 'date | required'
        ]);

        $fecha_inicio_comprobar = DateTime::createFromFormat('d/m/Y', $request->input('fecha_inicio'));
        $fecha_fin_estimada_comprobar = DateTime::createFromFormat('d/m/Y', $request->input('fecha_fin_estimada'));

        if( $fecha_fin_estimada_comprobar < $fecha_inicio_comprobar ){
            return redirect()->back();
        }

        $proyecto = new Proyecto();
        $proyecto->nombre = $request->input('nombre');
        $proyecto->descripcion = $request->input('descripcion');
        $proyecto->repositorio = $request->input('repositorio');
        $proyecto->fecha_inicio = $request->input('fecha_inicio');
        $proyecto->fecha_fin_estimada = $request->input('fecha_fin_estimada');

        $proyecto->save();

        $proyectoUser = new ProyectoUser();
        $user = User::where('id', Auth::id())->first();
        $rol = Rol::where('id', '1')->first();

        $proyectoUser->user()->associate($user->id);
        $proyectoUser->proyecto()->associate($proyecto->id);
        $proyectoUser->rol()->associate($rol->id);
        $proyectoUser->save();

    } 
}