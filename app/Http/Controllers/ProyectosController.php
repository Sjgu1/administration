<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Proyecto;


class ProyectosController extends Controller
{
    public function search(){
        $proyectos = Proyecto::get();
        return view('proyectos', compact('proyectos'));
    }
    
}
