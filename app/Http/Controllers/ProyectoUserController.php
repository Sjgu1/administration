<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ProyectoUser;

class ProyectoUserController extends Controller
{

    public function search($field = null){
        $proyectosusers = ProyectoUser::with('proyecto')->with('user')->with('rol')->paginate(8);
        /*$proyectosusers->proyecto = $proyectosusers->proyecto();
        $proyectosusers->rol = $proyectosusers->rol();
        $proyectosusers->usuario = $proyectosusers->usuario();*/

        $valorID = "";
        $valorNombre="";
        return view('proyectosusers', compact(['proyectosusers', 'valorID', 'valorNombre']));
    }
}
