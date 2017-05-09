<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Input;
use Illuminate\Support\Facades\Redirect;

use App\Rol;
use App\Permiso;
use App\RequisitoUser;
use App\User;
use App\Requisito;

class RequisitoUserController extends Controller
{
    public function modificarAsignaciones(Request $request){
        $tareasAsignadas = RequisitoUser::where('requisito_id', $request->id_requisito)->get();
        foreach($tareasAsignadas as $tareas){
            $eliminar = User::where('id', $tareas->user_id)->first();
            $eliminar->requisitos()->detach($tareas->requisito_id);
        }
        foreach($request->opciones as $asignacion){
            $user = User::where('id', $asignacion)->first();
            $user->requisitos()->attach($request->id_requisito);
        }
        return back()->withInput();
    }
   
}