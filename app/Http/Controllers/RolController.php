<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Input;
use App\Rol;
use App\Permiso;

class RolController extends Controller
{

    public function details($id){
        $rol = Rol::where('id', $id)->first();
        if($rol==null){
            return view('alerta_elemento',['slot'=> "No existe el elemento Rol: " .$id  ] );
        }else{
            return view('rol', ['rol' => $rol]);
        }
        
    }

    public function modify(Request $request){

        $rol = Rol::where('id', $request->input('id'))->first();
        $rol->nombre = $request->input('nombre');
        $rol->descripcion = $request->input('descripcion');

        $rol->save();
        return view('exito_elemento',['slot'=> "Se ha modificado el Rol: " .$rol->id  ] );

    }

    public function delete($id){

        $rol = Rol::where('id', $id)->first();
        $rol->delete();
        return view('exito_elemento',['slot'=> "Se ha eliminado el Rol: " .$rol->id  ] );

    }

     public function search(){
         $rols = Rol::with('permisos')->get();
         return view('rols', compact('rols'));
     }
    /*
    public function search($field = null){
        $rols = Rol::paginate(8);
        $valorID = "";
        $valorNombre="";
        return view('rols', compact(['rols', 'valorID', 'valorNombre']));
    }
    */
    public function filtrar(Request $request ){
        $id = $request->input('id');
        $name = $request->input('nombre');
        $nombre = Rol::firstOrNew(array('id' => $id));
        $paginate = 4;
        $page_no = isset($_GET['page']) ? $_GET['page'] : 1;
        $i = ($paginate * $page_no) - ($paginate - 1);
        $appends = array();
        

        $valorID = "";
        $valorNombre="";


        if ($id!=null) {
            $rolsID = Rol::get();
            foreach($rolsID as $rol){
                $idLeido = $rol->id;
                $idLeido = (string)$idLeido;
                $id = (string)$id;
                if(strpos($idLeido, $id ) !== false){
                    $appends[]= $rol->id;
                }           
            }
            $valorID = $id;
            
        } else {
            $nuevosRols = Rol::limit(-1);
        }
        if ($name!=null) {
            $rols = Rol::get();
            foreach($rols as $rol){
                $nombreLeido = $rol->nombre;
                $nombreLeido = strtolower($nombreLeido);
                $name = strtolower($name);
                if(strpos($nombreLeido, $name ) !== false){
                    $appends[]= $rol->id;
                }
                    
            }
            $valorNombre=$name;
        }
        if ($name==null && $id==null) {
        $rols = Rol::get();
        foreach($rols as $rol){
                $appends[]= $rol->id;
            }
        }
        
    
        $orden = $request->input('tipoOrdenacion');
        $ordenad = $request->input('campoOrdenado');
        if($ordenad == "id"){
            if($orden == "asc")
                $rolsDevolver = Rol::whereIn('id', $appends)->orderBy('id','asc')->paginate(3);
            else
                $rolsDevolver = Rol::whereIn('id', $appends)->orderBy('id','desc')->paginate(3);
        } else{
            if($orden == "asc")
                $rolsDevolver = Rol::whereIn('id', $appends)->orderBy('nombre','asc')->paginate(3);
            else
                $rolsDevolver = Rol::whereIn('id', $appends)->orderBy('nombre','desc')->paginate(3);
        }
        
        $rols = $rolsDevolver;

        return view('rols', compact(['rols','valorID','valorNombre']));
    
    }

    public function create(Request $request){

        $rol = new Rol();
        $rol->nombre = $request->input('nombre');
        $rol->descripcion = $request->input('descripcion');

        $rol->save();
        return redirect('rols');
    }
}