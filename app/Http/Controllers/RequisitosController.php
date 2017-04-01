<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Sprint;
use App\Requisito;

class RequisitosController extends Controller
{
    public function pagination(){
        $requisitos = Requisito::paginate(3);
        return view('index', compact('requisitos'));
    }

    public function search($field = null){

        if ($field == "nombre"){

            $requisitos = Requisito::orderBy('nombre', 'desc')->paginate(3);
            return view('index', compact('requisitos'));
        }
        else if ($field == "descripcion"){

            $requisitos = Requisito::orderBy('descripcion', 'desc')->paginate(3);
            return view('index', compact('requisitos'));
        }
        else {

            $requisitos = Requisito::paginate(3);
            return view('index', compact('requisitos'));
        }
    }

    public function details($id){

        $requisito = Requisito::where('id', $id)->first();
        return view('requisito', ['requisito' => $requisito]);
    }

    public function edit(Request $request){

        $requisito = Requisito::where('id', $request->input('id'))->first();
        $requisito->nombre = $request->input('nombre');
        $requisito->descripcion = $request->input('descripcion');

        $requisito->save();
        return back();

    }

    public function delete($id){

        $requisito = Requisito::where('id', $id)->first();
        $requisito->delete();

        return redirect('index');

    }

    public function create(Request $request){

        $requisito = new Requisito();
        $requisito->nombre = $request->input('nombre');
        $requisito->descripcion = $request->input('descripcion');
        $requisito->fecha_inicio = $request->input('fecha_inicio');
        $requisito->fecha_fin_estimada = $request->input('fecha_fin_estimada');
        $requisito->sprint_id = $request->input('sprint_id');

        $requisito->save();

        return redirect('index');
    }

    public function getSprints(){

        $sprints = Sprint::get();
        return view('requisito_new', ['sprints' => $sprints]);
    }

}
