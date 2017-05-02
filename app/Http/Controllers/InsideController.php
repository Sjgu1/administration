<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Input;
use App\RequisitoUser;
use App\ProyectoUser;
use App\Sprint;
use Auth;
use Log;

class InsideController extends Controller
{

 //Proyecto
    public function searchProyecto(){
         $user = Auth::id();
         Log::info($user);
         $proyectosusers = ProyectoUser::with('proyecto')->get()->where('user_id', $user);
         return view('user.proyectosusers', compact('proyectosusers'));
    }

    public function createProyecto(Request $request){
        $this->validate($request, [
            'nombre' => ['string', 'min:3', 'max:20'],
            'descripcion' => ['string', 'min:3', 'max:65535'],
            'repositorio' => 'url | nullable'
        ]);

        $proyecto = new Proyecto();
        $proyecto->nombre = $request->input('nombre');
        $proyecto->descripcion = $request->input('descripcion');
        $proyecto->repositorio = $request->input('repositorio');
        $proyecto->fecha_inicio = $request->input('fecha_inicio');
        $proyecto->fecha_fin_estimada = $request->input('fecha_fin_estimada');

        $proyecto->save();
        return redirect('user.proyectosusers');
    }

    public function searchRequisito(){
         $user = Auth::id();
         Log::info($user);
         $requisitosusers = RequisitoUser::with('requisito')->get()->where('user_id', $user);
         return view('user.requisitosusers', compact('requisitosusers'));
    }

    public function searchSprint(){
         $user = Auth::id();
         Log::info($user);
         $sprintsusers = Sprint::with('sprint')->get()->where('user_id', $user);
         return view('user.sprintsusers', compact('sprintsusers'));
    }
}


    
