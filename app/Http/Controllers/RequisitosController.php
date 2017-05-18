<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

use App\Proyecto;
use App\Sprint;
use App\Requisito;
use Log;
use Auth;


class RequisitosController extends Controller
{

    public function __construct(){
        
        parent::__construct();

        $this->middleware('auth');
    }

    public function cambiarEstado(Request $request){
        
        $requisito = Requisito::where('id', $request->id)->first();
        $requisito->estado= $request->estado;
        $requisito->save();
    }
    public function details($id){
        $requisito = Requisito::where('id', $id)->first();
        $requisito_sprint = Sprint::where('id', $requisito->sprint_id)->first();
        $proyectos = Proyecto::with('sprints')->get();

        if($requisito==null){
            return view('alerta_elemento', ['slot'=> "No existe el elemento Requisito: " .$id ] );
        }else{
            return view('requisito', ['requisito' => $requisito, 'requisito_sprint' => $requisito_sprint, 'proyectos' => $proyectos]);
        }
    }

    public function modify(Request $request){
        //$validator = Validator::make(Input::all(), $rules);
        $this->validate($request, [
            'nombre' => ['string', 'min:3', 'max:20'],
            'descripcion' => ['string', 'min:3', 'max:65535'],
        ]);

        $requisito = Requisito::where('id', $request->input('id'))->first();
        $requisito->nombre = $request->input('nombre');
        $requisito->descripcion = $request->input('descripcion');
        $requisito->fecha_fin_estimada = $request->input('fecha_estimada_fin');
        $requisito->sprint_id = $request->input('sprint_id');
        $requisito->save();
        return redirect()->back(); 
       
    }

    public function modify_public(Request $request){

    }
    
 public function modificarColores(Request $request){

        $requisito = Requisito::where('id', $request->input('requisito_id'))->first();
        $requisito->color=$request->input('color');

        $requisito->save();
    }
    public function delete($id){
        

        $requisito = Requisito::where('id', $id)->first();
        $requisito->delete();
        return redirect()->back();       // return view('exito_elemento',['slot'=> "Se ha eliminado el Requisito: " .$requisito->id  ] );

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

        $this->validate($request, [
            'nombre' => ['string', 'min:3', 'max:20'],
            'descripcion' => ['string', 'min:3', 'max:65535'],
        ]);

        $requisito = new Requisito();
        $requisito->nombre = $request->input('nombre');
        $requisito->descripcion = $request->input('descripcion');
        $requisito->sprint_id = $request->input('sprint_id');
        $requisito->estado="Por hacer";
        $requisito->fecha_fin_estimada = $request->input('fecha_estimada_fin');
        $requisito->fecha_inicio = date('d/m/Y');
        

        $requisito->save();
        return back()->withInput();

    }

    public function getSprints(){

        $proyectos = Proyecto::with('sprints')->get();
        return view('requisito_new', ['proyectos' => $proyectos]);
    }

}
