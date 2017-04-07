<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Input;
use App\Proyecto;
use App\Sprint;

class SprintController extends Controller
{

    public function details($id){

        $sprint = Sprint::where('id', $id)->first();
        $proyectos = Proyecto::get();

        if($sprint==null){
            return view('alerta_elemento',['slot'=> "No existe el elemento Sprint: " .$id  ] );
        }else{
            return view('sprint', ['sprint' => $sprint, 'proyectos' => $proyectos]);
        }
        
    }

    public function modify(Request $request){

        $this->validate($request, [
            'nombre' => ['string', 'min:3', 'max:20'],
            'proyecto_id' => 'required',
            'descripcion' => ['string', 'min:3', 'max:65535'],
            'fecha_inicio' => 'date_format:d/m/Y',
            'fecha_fin_estimada' => 'date_format:d/m/Y'
        ]);

        $sprint = Sprint::where('id', $request->input('id'))->first();
        $sprint->nombre = $request->input('nombre');
        $sprint->proyecto_id = $request->input('proyecto_id');
        $sprint->descripcion = $request->input('descripcion');
        $sprint->fecha_inicio = $request->input('fecha_inicio');
        $sprint->fecha_fin_estimada = $request->input('fecha_fin_estimada');

        $sprint->save();
        return view('exito_elemento',['slot'=> "Se ha modificado el Sprint: " .$sprint->id  ] );

    }

    public function delete($id){

        $sprint = Sprint::where('id', $id)->first();
        $sprint->delete();
        return view('exito_elemento',['slot'=> "Se ha eliminado el Sprint: " .$sprint->id  ] );

    }
    public function create(Request $request){

        $this->validate($request, [
            'nombre' => ['string', 'min:3', 'max:20'],
            'descripcion' => ['string', 'min:3', 'max:65535'],
            'fecha_inicio' => 'date_format:d/m/Y',
            'fecha_fin_estimada' => 'date_format:d/m/Y'
        ]);

        $sprint = new Sprint();
        $sprint->nombre = $request->input('nombre');
        $sprint->descripcion = $request->input('descripcion');
        $sprint->fecha_inicio = $request->input('fecha_inicio');
        $sprint->fecha_fin_estimada = $request->input('fecha_fin_estimada');
        $sprint->proyecto_id = $request->input('proyecto_id');

        $sprint->save();

        return redirect('sprints');
    }

    public function getProyectos(){

        $proyectos = Proyecto::get();
        return view('sprint_new', ['proyectos' => $proyectos]);
    }
/*
    public function search($field = null){
        $sprints = Sprint::with('proyecto')->paginate(3);
        $valorID = "";
        $valorNombre="";
        $valorProyecto="";
        return view('sprints', compact(['sprints', 'valorID', 'valorNombre', 'valorProyecto']));
    }
*/
    public function search(){
         $sprints = Sprint::with('proyecto')->get();
         return view('sprints', compact('sprints'));
     }
    public function filtrar(Request $request ){
        $id = $request->input('id');
        $name = $request->input('nombre');
        $proyecto = $request->input('proyecto');
        $nombre = Sprint::firstOrNew(array('id' => $id));
        $paginate = 4;
        $page_no = isset($_GET['page']) ? $_GET['page'] : 1;
        $i = ($paginate * $page_no) - ($paginate - 1);
        $appends = array();
        

        $valorID = "";
        $valorNombre="";
        $valorProyecto="";
        if($proyecto!=null){
            $valorProyecto=$proyecto;
        }
        if ($id!=null) {
            $sprintsID = Sprint::get();
            foreach($sprintsID as $sprint){
                $idLeido = $sprint->id;
                $idLeido = (string)$idLeido;
                $id = (string)$id;
                if(strpos($idLeido, $id ) !== false){
                    $appends[]= $sprint->id;
                }           
            }
            $valorID = $id;
            
        } else {
            $nuevosSprints = Sprint::limit(-1);
        }
        if ($name!=null) {
            $sprints = Sprint::get();
            foreach($sprints as $sprint){
                $nombreLeido = $sprint->nombre;
                $nombreLeido = strtolower($nombreLeido);
                $name = strtolower($name);
                if(strpos($nombreLeido, $name ) !== false){
                    $appends[]= $sprint->id;
                }
                    
            }
            $valorNombre=$name;
        }
        if ($name==null && $id==null) {
        $sprints = Sprint::get();
        foreach($sprints as $sprint){
                $appends[]= $sprint->id;
            }
        }
        
    
        $orden = $request->input('tipoOrdenacion');
        $ordenad = $request->input('campoOrdenado');
        if($ordenad == "id"){
            if($orden == "asc")
                $sprintsDevolver = Sprint::whereIn('id', $appends)->orderBy('id','asc')->paginate(3);
            else
                $sprintsDevolver = Sprint::whereIn('id', $appends)->orderBy('id','desc')->paginate(3);
        }else if($ordenad == "proyecto"){
            if($orden == "asc")
                $sprintsDevolver = Sprint::whereIn('id', $appends)->orderBy('proyecto_id','asc')->paginate(3);
            else
                $sprintsDevolver = Sprint::whereIn('id', $appends)->orderBy('proyecto_id','desc')->paginate(3);
        }else{
            if($orden == "asc")
                $sprintsDevolver = Sprint::whereIn('id', $appends)->orderBy('nombre','asc')->paginate(3);
            else
                $sprintsDevolver = Sprint::whereIn('id', $appends)->orderBy('nombre','desc')->paginate(3);
        }
        
        $sprints = $sprintsDevolver;

        return view('sprints', compact(['sprints','valorID','valorNombre', 'valorProyecto']));
    
    }

}
