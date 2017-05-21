<?php

namespace App\Http\Controllers;
use Illuminate\Session\Store;

use Illuminate\Http\Request;
use App\Http\Controllers\Input;
use Validator;
use App\Proyecto;
use App\Sprint;
use App\Requisito;
use Auth;
use Log;
use App\ProyectoUser;
use App\RequisitoUser;
use DateTime;
use DateInterval;

class SprintController extends Controller
{

    public function __construct(){
        
        parent::__construct();
        $this->middleware('auth');
    }
    public function pizarra($id){

         $proyecto= session()->get('selected_project');
         $sprint = Sprint::get()
                    ->where('id', $id)
                    ->first();
         $proyectousers = ProyectoUser::with('user')->where('proyecto_id', $proyecto->id)->get();
         $usuarios = ProyectoUser::with('user')
                    ->where('proyecto_id',$proyecto->id)
                    ->get();
        $requisitosAsignados = RequisitoUser::with('user', 'requisito')
                    ->get();
         $requisitos = Requisito::get()
                    ->where('sprint_id', $sprint->id);

        // Permisos
        $modificar_sprint = ProyectosController::permisoChecker('modificar_sprint');
        $modificar_requisito = ProyectosController::permisoChecker('modificar_requisito');
        $borrar_requisito = ProyectosController::permisoChecker('borrar_requisito');
        $crear_requisito = ProyectosController::permisoChecker('crear_requisito');
        // /Permisos

        $modificacions_raw = ProyectosController::getHistorico();
        $modificacions = array();

        foreach ($modificacions_raw as $modificacion){

            if (array_key_exists($modificacion['id'], $modificacions)){

                array_push($modificacions[$modificacion['id']], $modificacion);
            }
            else {

                $modificacions[$modificacion['id']] = array();
                array_push($modificacions[$modificacion['id']], $modificacion);
            }
        }

        $users = array();

        foreach ($proyectousers as $user){

            array_push($users, $user->user);
        }

        // Permisos
        // /Permisos
        
        return view('user.pizarra', compact('requisitos', 'proyecto', 'sprint', 'usuarios', 'requisitosAsignados', 'modificacions', 'users', 'modificar_sprint', 'modificar_requisito', 'borrar_requisito', 'crear_requisito'));
    }
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
            'nombre' => ['string', 'min:3', 'max:50'],
            'descripcion' => ['string', 'min:3', 'max:65535'],
            'fecha_inicio' => ['required'],
            'fecha_estimada_fin' => ['required']
        ]);

        $fecha_inicio_comprobar = DateTime::createFromFormat('d/m/Y',$request->input('fecha_inicio'));
        $fecha_fin_estimada_comprobar = DateTime::createFromFormat('d/m/Y', $request->input('fecha_fin_estimada'));
        $fecha_fin_comprobar = DateTime::createFromFormat('d/m/Y', $request->input('fecha_fin'));

        if( $fecha_fin_estimada_comprobar < $fecha_inicio_comprobar ){
            return redirect()->back()->with('message', 'Error al modificar el proyecto, compruebe las fechas');
        }
        if( $fecha_fin_comprobar < $fecha_inicio_comprobar ){
            return redirect()->back()->with('message', 'Error al modificar el proyecto, compruebe las fechas');
        }

        $sprint = Sprint::where('id', $request->input('id'))->first();
        $sprint->nombre = $request->input('nombre');
        $sprint->proyecto_id = $request->input('proyecto_id');
        $sprint->descripcion = $request->input('descripcion');
        $sprint->fecha_inicio = $request->input('fecha_inicio');
        $sprint->fecha_fin= $request->input('fecha_fin');
        $sprint->fecha_fin_estimada = $request->input('fecha_fin_estimada');

        
        $success =  $sprint->save();
    
        if($success){
            return redirect()->back()->with('message', 'Se ha modificado el sprint correctamente')->with('exito', 'eliminado');  
        }else{
             return redirect()->back()->with('message', 'Error al modificar el sprint');
        }

    }
    public function modificarColores(Request $request){

        $sprint = Sprint::where('id', $request->input('sprint_id'))->first();
        if($request->input('columna')=="columna1" && $request->input('cambiar') =="fondo"){
            $sprint->color1 = $request->input('color');
        }elseif($request->input('columna')=="columna2" && $request->input('cambiar') =="fondo"){
            $sprint->color2 = $request->input('color');
        }elseif($request->input('columna')=="columna3" && $request->input('cambiar') =="fondo"){
            $sprint->color3 = $request->input('color');
        } if($request->input('columna')=="columna1" && $request->input('cambiar') =="texto"){
            $sprint->colorTexto1 = $request->input('color');
        }elseif($request->input('columna')=="columna2" && $request->input('cambiar') =="texto"){
            $sprint->colorTexto2 = $request->input('color');
        }elseif($request->input('columna')=="columna3" && $request->input('cambiar') =="texto"){
            $sprint->colorTexto3 = $request->input('color');
        }

        $sprint->save();
    }

    public function delete($id){

        $sprint = Sprint::where('id', $id)->first();
        $success =  $sprint->delete();
    
        if($success){
            return redirect('/userspublic')->with('message', 'Se ha eliminado el sprint correctamente')->with('exito', 'eliminado');  
        }else{
             return redirect()->back()->with('message', 'Error al eliminar el sprint');
        }

    }
    public function create(Request $request){

        $this->validate($request, [
            'nombre' => ['string', 'min:3', 'max:50'],
            'descripcion' => ['string', 'min:3', 'max:65535'],
            'fecha_inicio' => ['required'],
            'fecha_fin_estimada' => ['required']

        ]);

        $fecha_inicio_comprobar = DateTime::createFromFormat('d/m/Y',$request->input('fecha_inicio'));
        $fecha_fin_estimada_comprobar = DateTime::createFromFormat('d/m/Y', $request->input('fecha_fin_estimada'));

        if( $fecha_fin_estimada_comprobar < $fecha_inicio_comprobar ){
            return redirect()->back()->with('message', 'Error al modificar el proyecto, compruebe las fechas');
        }
        

        $sprint = new Sprint();
        $sprint->nombre = $request->input('nombre');
        $sprint->descripcion = $request->input('descripcion');
        $sprint->fecha_inicio = $request->input('fecha_inicio');
        $sprint->fecha_fin_estimada = $request->input('fecha_fin_estimada');
        $sprint->proyecto_id = $request->input('proyecto_id');

        $sprint->save();

        return back();
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

    public function sprintsrequisitos($sprint_id){

        $proyecto = session()->get('selected_project');
        $sprint = Sprint::where('id', $sprint_id)->first();
        $requisitos = Requisito::where('sprint_id', $sprint_id)->with('users')->with('modificacions')->get();
        $proyectousers = ProyectoUser::with('user')->where('proyecto_id', $proyecto->id)->get();
        $users = array();

        foreach ($proyectousers as $user){

            array_push($users, $user->user);
        }

        $modificacions_raw = ProyectosController::getHistorico();
        $modificacions = array();

        foreach ($modificacions_raw as $modificacion){

            if (array_key_exists($modificacion['id'], $modificacions)){

                array_push($modificacions[$modificacion['id']], $modificacion);
            }
            else {

                $modificacions[$modificacion['id']] = array();
                array_push($modificacions[$modificacion['id']], $modificacion);
            }
        }

        $requisitos_no_finalizados = array();
        $requisitos_finalizados = array();

        foreach ($requisitos as $requisito){

            $fecha_inicio = DateTime::createFromFormat('d/m/Y', $requisito->fecha_inicio);
            $fecha_fin_estimada = DateTime::createFromFormat('d/m/Y', $requisito->fecha_fin_estimada);
            $fecha_dia_de_hoy = new DateTime('NOW');
            
            if ($requisito->estado == 'Por hacer' || $requisito->estado == 'En trámite'){

                $dias_totales = $fecha_inicio->diff($fecha_fin_estimada)->format('%a');
                $dias_que_llevo = $fecha_dia_de_hoy->diff($fecha_fin_estimada)->format('%a');

                $requisito->progreso = ($dias_totales == 0 ? 100 . '%' : floor($dias_que_llevo / $dias_totales * 100) . '%');
                $requisito->porcentaje = $requisito->progreso;

                $diferencia = 0;

                // Lleva retraso
                if ($fecha_fin_estimada < $fecha_dia_de_hoy){

                    $diferencia = $fecha_fin_estimada->diff($fecha_dia_de_hoy)->format('%a');
                    $requisito->finalizacion = "Hace " . $diferencia;
                    $requisito->color = 'red';
                    $requisito->stripped = '';
                    $requisito->porcentaje = '<i class="icon fa fa-warning"></i>';

                }
                // O se estima que acabe hoy, o que acabe en días posteriores. Va bien.
                else {

                    $diferencia = $fecha_dia_de_hoy->diff($fecha_fin_estimada)->format('%a');

                    if ($fecha_dia_de_hoy >= $fecha_inicio){

                        $requisito->finalizacion = "En " . $diferencia;
                        $requisito->color = 'green';
                        $requisito->stripped = 'progress-striped';

                    }
                    else {

                        $requisito->finalizacion = "En " . $diferencia;
                        $requisito->progreso = '0%';
                        $requisito->porcentaje = $requisito->progreso;

                    }
                }

                if ($diferencia == 1){

                    $requisito->finalizacion = $requisito->finalizacion . " día";
                }
                else {

                    $requisito->finalizacion = $requisito->finalizacion . " días";
                }

                array_push($requisitos_no_finalizados, $requisito);
            }
            else {

                $fecha_fin = DateTime::createFromFormat('d/m/Y', $requisito->fecha_fin);
                $diferencia = $fecha_inicio->diff($fecha_fin)->format('%a');

                if ($diferencia / 7 > 1){

                    $requisito->duracion = floor($diferencia / 7) . " semanas";

                    if ($diferencia > 0){

                        $aux_aux = $fecha_inicio->diff($fecha_fin);
                        
                        if ($diferencia > 1){

                            $requisito->duracion = $requisito->duracion . " y " . $aux_aux->d . " días";
                        }
                        else {

                            $requisito->duracion = $requisito->duracion . " y " . $aux_aux->d . " día";
                        }
                    }
                }
                else if (floor($diferencia / 7) == 1){

                    $requisito->duracion = "1 semana";

                    if ($diferencia > 0){

                        $aux_aux = $fecha_inicio->diff($fecha_fin);

                        if ($diferencia > 1){

                            $requisito->duracion = $requisito->duracion . " y " . $aux_aux . " días";
                        }
                        else {

                            $requisito->duracion = $requisito->duracion . " y " . $aux_aux . " día";
                        }
                    }

                }
                else if ($diferencia > 1){

                    $requisito->duracion = $diferencia . " días";
                }
                else {

                    $requisito->duracion = "1 día";
                }

                array_push($requisitos_finalizados, $requisito);
            }
        }

        $proyecto = session()->get('selected_project');

        // Permisos
        $modificar_sprint = ProyectosController::permisoChecker('modificar_sprint');
        $borrar_sprint = ProyectosController::permisoChecker('borrar_sprint');
        $modificar_requisito = ProyectosController::permisoChecker('modificar_requisito');
        $borrar_requisito = ProyectosController::permisoChecker('borrar_requisito');
        // /Permisos

        return view('user.sprintsrequisitos', ['proyecto' => $proyecto, 'sprint' => $sprint, 'users' => $users, 'requisitos' => $requisitos, 'modificacions' => $modificacions, 'requisitos_no_finalizados' => $requisitos_no_finalizados, 'requisitos_finalizados' => $requisitos_finalizados, 'modificar_sprint' => $modificar_sprint, 'borrar_sprint' => $borrar_sprint, 'modificar_requisito' => $modificar_requisito, 'borrar_requisito' => $borrar_requisito]);
    }

}
