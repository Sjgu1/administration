<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Input;
use App\RequisitoUser;
use App\Proyecto;
use App\ProyectoUser;
use App\Sprint;
use Auth;
use Log;

class InsideController extends Controller
{

    public function __construct(){

        parent::__construct();
        
        $this->middleware('auth');
    }

    public function setSession(Request $request){
        $project = Proyecto::where('id', $request->selected_project['id'])->first() ;
        session()->put('selected_project', $project);
        $var =   session()->get('selected_project');

    }
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
            'fecha_inicio'=> 'required',
            'fecha_fin_estimada'=> 'required'
        ]);

        $fecha_inicio_comprobar = DateTime::createFromFormat('d/m/Y', $request->input('fecha_inicio'));
        $fecha_fin_estimada_comprobar = DateTime::createFromFormat('d/m/Y', $request->input('fecha_fin_estimada'));

        if( $fecha_fin_estimada_comprobar < $fecha_inicio_comprobar ){
            return redirect()->back()->with('message', "Error al guardar el proyecto, compruebe las fechas");
        }

        $proyecto = new Proyecto();
        $proyecto->nombre = $request->input('nombre');
        $proyecto->descripcion = $request->input('descripcion');
        $proyecto->repositorio = $request->input('repositorio');
        $proyecto->fecha_inicio = $request->input('fecha_inicio');
        $proyecto->fecha_fin_estimada = $request->input('fecha_fin_estimada');



        $exito= $proyecto->save();
        if($exito){
            return redirect('user.proyectosusers')->with('message', 'Se ha creado el proyecto ');
        }else{
            return redirect()->back()->with('message', 'Error al guardar el proyecto, compruebe todos los datos.');
        }
        
    }

    public function searchRequisito(){
         $user = Auth::id();
         Log::info($user);
         $requisitosusers = RequisitoUser::with('requisito')->get()->where('user_id', $user);
         return view('user.requisitosusers', compact('requisitosusers'));
    }

    public function createRequisito(Request $request){

        $this->validate($request, [
            'nombre' => ['string', 'min:3', 'max:20'],
            'descripcion' => ['string', 'min:3', 'max:65535'],
        ]);

        $requisito = new Requisito();
        $requisito->nombre = $request->input('nombre');
        $requisito->descripcion = $request->input('descripcion');
        $requisito->sprint_id = $request->input('sprint_id');
        $requisito->fecha_inicio = '20/06/2017';
        
        $requisito->save();
        return redirect('user.requisitosusers');
    }

    public function searchSprint(){
         $user = Auth::id();
         Log::info($user);
         $sprintsusers = Sprint::with('sprint')->get()->where('user_id', $user);
         return view('user.sprintsusers', compact('sprintsusers'));
    }
}


    
