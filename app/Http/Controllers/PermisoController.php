<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Permiso;
use App\Proyecto;
use App\Sprint;

class PermisoController extends Controller
{

    public function search(){

        $permisos = Permiso::get();
        return view('permisos', compact('permisos'));
    }

    public function create(Request $request){

        $proyecto = new Permiso();
        $proyecto->nombre = $request->input('nombre');
        $proyecto->descripcion = $request->input('descripcion');

        $proyecto->save();
        return redirect('permisos');
    }
}
