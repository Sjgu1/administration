<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Proyecto;
use App\Sprint;

class SprintController extends Controller
{

    public function create(Request $request){

        $sprint = new Sprint();
        $sprint->nombre = $request->input('nombre');
        $sprint->descripcion = $request->input('descripcion');
        $sprint->fecha_inicio = $request->input('fecha_inicio');
        $sprint->fecha_fin_estimada = $request->input('fecha_fin_estimada');
        $sprint->proyecto_id = $request->input('proyecto_id');

        $sprint->save();

        return redirect('index');
    }

    public function getProyectos(){

        $proyectos = Proyecto::get();
        return view('sprint_new', ['proyectos' => $proyectos]);
    }

}
