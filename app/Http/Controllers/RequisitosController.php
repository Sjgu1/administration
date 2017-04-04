<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Sprint;
use App\Requisito;
use App\Proyecto;

class RequisitosController extends Controller
{
    public function details($id){
        $requisito = Requisito::where('id', $id)->first();
        if($requisito==null){
            return view('alerta_elemento', ['slot'=> "No existe el elemento Requisito: " .$id ] );
        }else{
        return view('requisito', ['requisito' => $requisito]);
        }
    }

    public function modify(Request $request){
        $requisito = Requisito::where('id', $request->input('id'))->first();
        $requisito->nombre = $request->input('nombre');
        $requisito->descripcion = $request->input('descripcion');

        $requisito->save();
        return view('exito_elemento',['slot'=> "Se ha modificado el Requisito: " .$requisito->id  ] );
    }

    public function delete($id){

        $requisito = Requisito::where('id', $id)->first();
        $requisito->delete();
        return view('exito_elemento',['slot'=> "Se ha eliminado el Requisito: " .$requisito->id  ] );

    }

    public function pagination(){
        $requisitos = Requisito::paginate(3);
        return view('index', compact('requisitos'));
    }

    /*
     public function search($field = null){
        $requisitos = Requisito::paginate(8);
        $valorID = "";
        $valorNombre="";
        return view('requisitos', compact(['requisitos', 'valorID', 'valorNombre']));
    }
*/
    public function search(){
         $requisitos = requisito::with('sprint')->get();
         return view('requisitos', compact('requisitos'));
     }

   public function filtrar(Request $request ){
        $id = $request->input('id');
        $name = $request->input('nombre');
        $nombre = Requisito::firstOrNew(array('id' => $id));
        $paginate = 4;
        $page_no = isset($_GET['page']) ? $_GET['page'] : 1;
        $i = ($paginate * $page_no) - ($paginate - 1);
        $appends = array();
        

        $valorID = "";
        $valorNombre="";


        if ($id!=null) {
            $requisitosID = Requisito::get();
            foreach($requisitosID as $requisito){
                $idLeido = $requisito->id;
                $idLeido = (string)$idLeido;
                $id = (string)$id;
                if(strpos($idLeido, $id ) !== false){
                    $appends[]= $requisito->id;
                }           
            }
            $valorID = $id;
            
        } else {
            $nuevoRequisitos = Requisito::limit(-1);
        }
        if ($name!=null) {
            $requisitos = Requisito::get();
            foreach($requisitos as $requisito){
                $nombreLeido = $requisito->nombre;
                $nombreLeido = strtolower($nombreLeido);
                $name = strtolower($name);
                if(strpos($nombreLeido, $name ) !== false){
                    $appends[]= $requisito->id;
                }
                    
            }
            $valorNombre=$name;
        }
        if ($name==null && $id==null) {
        $requisitos = Requisito::get();
        foreach($requisitos as $requisito){
                $appends[]= $requisito->id;
            }
        }
        
    
        $orden = $request->input('tipoOrdenacion');
        $ordenad = $request->input('campoOrdenado');
        if($ordenad == "id"){
            if($orden == "asc")
                $requisitosDevolver = Requisito::whereIn('id', $appends)->orderBy('id','asc')->paginate(3);
            else
                $requisitosDevolver = Requisito::whereIn('id', $appends)->orderBy('id','desc')->paginate(3);
        } else{
            if($orden == "asc")
                $requisitosDevolver = Requisito::whereIn('id', $appends)->orderBy('nombre','asc')->paginate(3);
            else
                $requisitosDevolver = Requisito::whereIn('id', $appends)->orderBy('nombre','desc')->paginate(3);
        }
        
        $requisitos = $requisitosDevolver;

        return view('requisitos', compact(['requisitos','valorID','valorNombre']));
    
    }

    public function create(Request $request){

        $requisito = new Requisito();
        $requisito->nombre = $request->input('nombre');
        $requisito->descripcion = $request->input('descripcion');
        

        $requisito->save();
        return redirect('requisitos');
    }

    public function getSprints(){

        $sprints = Sprint::get();
        return view('requisito_new', ['sprints' => $sprints]);
    }

}
