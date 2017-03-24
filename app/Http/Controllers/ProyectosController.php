<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Proyecto;


class ProyectosController extends Controller
{
    public function create(Request $request){

        $proyecto = new Proyecto();
        $proyecto->nombre = $request->input('nombre');
        $proyecto->descripcion = $request->input('descripcion');
        $proyecto->repositorio = $request->input('repositorio');
        $proyecto->fecha_inicio = $request->input('fecha_inicio');
        $proyecto->fecha_fin_estimada = $request->input('fecha_fin_estimada');

        $proyecto->save();
        return redirect('proyectos');
    }

    public function search(){
        $proyectos = Proyecto::get();
        return view('proyectos', compact('proyectos'));
    }
    
}
