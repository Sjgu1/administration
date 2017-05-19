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
use App\Modificacion;
use App\RequisitoUser;
use App\User;
use DateTime;


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

        //$validator = Validator::make(Input::all(), $rules);
        $this->validate($request, [
            'nombre' => ['string', 'min:3', 'max:20'],
            'descripcion' => ['string', 'min:3', 'max:65535'],
        ]);

        $input_nombre = $request->input('input_nombre');
        $input_descripcion = $request->input('input_descripcion');
        $input_fecha_fin_estimada = $request->input('input_fecha_estimada_fin');
        $input_user = $request->input('input_user');
        $input_color = $request->input('input_color');

        $requisito = Requisito::where('id', $request->input('input_id'))->first();
        $requisito_user = RequisitoUser::where('requisito_id', $request->input('input_id'))->with('user')->first();
        $user_object = Auth::user();
        //$requisito->save();
        /*$requisito->nombre = $request->input('nombre');
        $requisito->descripcion = $request->input('descripcion');
        $requisito->fecha_fin_estimada = $request->input('fecha_estimada_fin');*/

        // Check changes
        $count_changes = 0;
        $changes = array();
        $changes['nombre'] = false;
        $changes['descripcion'] = false;
        $changes['fecha_fin_estimada'] = false;
        $changes['user'] = false;
        //$changes['color'] = false;
        $cambio_en_user = '';

        if ($input_nombre != $requisito->nombre){ $count_changes++; $changes['nombre'] = true; }
        if ($input_descripcion != $requisito->descripcion){ $count_changes++; $changes['descripcion'] = true; }
        if ($input_fecha_fin_estimada != $requisito->fecha_fin_estimada){ $count_changes++; $changes['fecha_fin_estimada'] = true; }
        //if ($input_color != $requisito->color){ $count_changes++; $changes['color'] = true; }

        // Solo se puede haber añadido un usuario
        if ($requisito_user == null){

            // Se ha añadido un usuario
            if ($input_user != 'null'){

                $changes['user'] = true;
                $count_changes++;
                $cambio_en_user = 'add';
            }
        }
        else {

            // O lo ha quitado
            if ($input_user == 'null'){

                $changes['user'] = true;
                $count_changes++;
                $cambio_en_user = 'erase';
            }
            // O lo ha cambiado
            else if ($input_user != $requisito_user->user->id){

                $changes['user'] = true;
                $count_changes++;
                $cambio_en_user = 'swap';
            }
        }
        // /Check changes

        var_dump($changes);

        $modificacion = new Modificacion();

        if ($count_changes == 1){

            if ($changes['nombre']){

                $modificacion->tipo = 'edit_title';
                $modificacion->mensaje = $user_object->name . ' ' . $user_object->apellidos . ':' . $requisito->nombre . ';' . $input_nombre;
            }
            else if ($changes['descripcion']){

                $modificacion->tipo = 'edit_description';
                $modificacion->mensaje = $user_object->name . ' ' . $user_object->apellidos . ':' . $requisito->descripcion . ';' . $input_descripcion;
            }
            else if ($changes['fecha_fin_estimada']){

                $modificacion->tipo = 'edit_fecha_fin_estimada';
                $modificacion->mensaje = $user_object->name . ' ' . $user_object->apellidos . ':' . $requisito->fecha_fin_estimada . ';' . $input_fecha_fin_estimada;
            }
            else {

                $user_aux = User::where('id', $input_user)->first();

                if ($user_aux == null){
                    
                    $user_aux = new User();
                    $user_aux->name = $requisito_user->user->name;
                    $user_aux->apellidos = $requisito_user->user->apellidos;
                }

                if ($cambio_en_user == 'add'){

                    $modificacion->tipo = 'add_user';
                    $modificacion->mensaje = $user_object->name . ' ' . $user_object->apellidos . ':' . $user_aux->name . ' ' . $user_aux->apellidos;
                }
                else if ($cambio_en_user == 'erase'){

                    $modificacion->tipo = 'delete_user';
                    $modificacion->mensaje = $user_object->name . ' ' . $user_object->apellidos . ':' . $user_aux->name . ' ' . $user_aux->apellidos;
                }
                else if ($cambio_en_user == 'swap'){

                    $modificacion->tipo = 'add_user';
                    $modificacion->mensaje = $user_object->name . ' ' . $user_object->apellidos . ':' . $user_aux->name . ' ' . $user_aux->apellidos;
                }

            }

            $fecha_del_sistema = new DateTime('NOW');
            $modificacion->fecha = $fecha_del_sistema->format('d/m/Y H:i:s');
            $modificacion->requisito()->associate($requisito);
            $modificacion->save();

        }
        else if ($count_changes > 1){

            $modificacion->tipo = 'edit_multiple_changes';
            $modificacion->mensaje = $user_object->name . ' ' . $user_object->apellidos;

            $fecha_del_sistema = new DateTime('NOW');
            $modificacion->fecha = $fecha_del_sistema->format('d/m/Y H:i:s');
            $modificacion->requisito()->associate($requisito);
            $modificacion->save();

        }
        else {

            // No hay cambios
        }

        $requisito->nombre = $input_nombre;
        $requisito->descripcion = $input_descripcion;
        $requisito->fecha_fin_estimada = $input_fecha_fin_estimada;
        $requisito->color = $input_color;
        $requisito->save();

        if ($input_user != 'null'){

            $deleter = RequisitoUser::where('requisito_id', $requisito->id)->delete();

            $requisito->users()->attach($input_user);
            /*$requisito_user = new RequisitoUser();
            $requisito_user->requisito()->associate($requisito->id);
            $requisito_user->user()->associate($input_user);*/
        }
        else {

            $deleter = RequisitoUser::where('requisito_id', $requisito->id)->delete();
        }

        return redirect()->back();
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
