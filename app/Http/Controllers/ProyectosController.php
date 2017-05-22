<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Input;
use App\Proyecto;
use App\Sprint;
use DateTime;
use DateTimeZone;
use DateInterval;
use App\ProyectoUser;
use App\Requisito;
use App\User;
use App\Rol;
use Auth;
use Log;
use DB;
use App\Permiso;
use App\ServiceLayer\ProyectoServices;

class ProyectosController extends Controller
{

    public function __construct(){

        parent::__construct();

        $this->middleware('auth');
        //$this->middleware('admin');
        
    }
    public function details($id){
        $proyecto = Proyecto::where('id', $id)->first();
        if($proyecto==null){
            return view('alerta_elemento',['slot'=> "No existe el elemento Proyecto: " .$id  ] );
        }else{
            return view('proyecto', ['proyecto' => $proyecto]);
        }
        
    }

    public static function permisoChecker($nombre_permiso){

        $aux = ProyectoUser::where('proyecto_id', session()->get('selected_project')->id)->where('user_id', Auth::user()->id)->with('rol')->first();
        $permisos = DB::table('permiso_rol')->where('rol_id', $aux->rol_id)->get();
        $allowed = false;

        //var_dump($permisos);

        foreach ($permisos as $perm_aux){

            $permiso = Permiso::where('id', $perm_aux->permiso_id)->first();

            if ($permiso->nombre == $nombre_permiso){

                $allowed = true;
                break;
            }
        }

        return $allowed;
    }

    public function modify(Request $request){

         $this->validate($request, [
            'nombre' => ['string', 'min:3', 'max:20'],
            'descripcion' => ['string', 'min:3', 'max:65535'],
            'repositorio' => 'url | nullable',
            'fecha_fin_estimada'=> 'required',
            'fecha_fin'=> 'nullable'
        ]);
        $proyecto = Proyecto::where('id', $request->input('id'))->first();

        $fecha_inicio_comprobar = DateTime::createFromFormat('d/m/Y', $proyecto->fecha_inicio);
        $fecha_fin_estimada_comprobar = DateTime::createFromFormat('d/m/Y', $request->input('fecha_fin_estimada'));
        $fecha_fin_comprobar = DateTime::createFromFormat('d/m/Y', $request->input('fecha_fin'));

        if( $fecha_fin_estimada_comprobar < $fecha_inicio_comprobar ){
            return redirect()->back()->with('message', 'Error al modificar el proyecto, compruebe las fechas');
        }
        if( $fecha_fin_comprobar!= null && $fecha_fin_comprobar < $fecha_inicio_comprobar ){
            return redirect()->back()->with('message', 'Error al modificar el proyecto, compruebe las fechas');
        }
        
        $proyecto->nombre = $request->input('nombre');
        $proyecto->descripcion = $request->input('descripcion');
        $proyecto->repositorio = $request->input('repositorio');
        $proyecto->fecha_fin = $request->input('fecha_fin');
        $proyecto->repositorio = $request->input('repositorio');
        $proyecto->fecha_fin_estimada = $request->input('fecha_fin_estimada');

        $success =   $proyecto->save();
         session()->put("selected_project", Proyecto::where('id', $request->input('id'))->first() );
        if($success){
            return redirect()->back()->with('message', 'Se ha modificado el proyecto correctamente')->with('exito', 'eliminado');  
        }else{
             return redirect()->back()->with('message', 'Error al modificar el proyecto');
        }
       

    }

    public function delete($id){

        $proyecto = Proyecto::where('id', $id)->first();
        $success = $proyecto->delete(); 
        if($success){
            session()->forget('selected_project');
            return redirect('/user/proyectosusers')->with('message', 'Se ha eliminado el proyecto correctamente')->with('exito', 'eliminado');  
        }else{
             return redirect()->back()->with('message', 'Error al eliminar el proyecto');
        }
        return view('exito_elemento',['slot'=> "Se ha eliminado el Proyecto: " .$proyecto->id  ] );

    }

    //Funcion para la vista alternativa
    /*
    public function search($field = null){
        $proyectos = Proyecto::paginate(8);
        $valorID = "";
        $valorNombre="";
        return view('proyectos', compact(['proyectos', 'valorID', 'valorNombre']));
    }*/

    public function search(){
         $proyectos = Proyecto::get();
         return view('proyectos', compact('proyectos'));
     }

     //Solo se usa en la vista alternativa
    public function filtrar(Request $request ){
        $id = $request->input('id');
        $name = $request->input('nombre');
        $nombre = Proyecto::firstOrNew(array('id' => $id));
        $paginate = 4;
        $page_no = isset($_GET['page']) ? $_GET['page'] : 1;
        $i = ($paginate * $page_no) - ($paginate - 1);
        $appends = array();
        

        $valorID = "";
        $valorNombre="";


        if ($id!=null) {
            $proyectosID = Proyecto::get();
            foreach($proyectosID as $proyecto){
                $idLeido = $proyecto->id;
                $idLeido = (string)$idLeido;
                $id = (string)$id;
                if(strpos($idLeido, $id ) !== false){
                    $appends[]= $proyecto->id;
                }           
            }
            $valorID = $id;
            
        } else {
            $nuevosProyectos = Proyecto::limit(-1);
        }
        if ($name!=null) {
            $proyectos = Proyecto::get();
            foreach($proyectos as $proyecto){
                $nombreLeido = $proyecto->nombre;
                $nombreLeido = strtolower($nombreLeido);
                $name = strtolower($name);
                if(strpos($nombreLeido, $name ) !== false){
                    $appends[]= $proyecto->id;
                }
                    
            }
            $valorNombre=$name;
        }
        if ($name==null && $id==null) {
        $proyectos = Proyecto::get();
        foreach($proyectos as $proyecto){
                $appends[]= $proyecto->id;
            }
        }
        
    
        $orden = $request->input('tipoOrdenacion');
        $ordenad = $request->input('campoOrdenado');
        if($ordenad == "id"){
            if($orden == "asc")
                $proyectosDevolver = Proyecto::whereIn('id', $appends)->orderBy('id','asc')->paginate(3);
            else
                $proyectosDevolver = Proyecto::whereIn('id', $appends)->orderBy('id','desc')->paginate(3);
        } else{
            if($orden == "asc")
                $proyectosDevolver = Proyecto::whereIn('id', $appends)->orderBy('nombre','asc')->paginate(3);
            else
                $proyectosDevolver = Proyecto::whereIn('id', $appends)->orderBy('nombre','desc')->paginate(3);
        }
        
        $proyectos = $proyectosDevolver;

        return view('proyectos', compact(['proyectos','valorID','valorNombre']));
    
    }

    public function create(Request $request){

        ProyectoServices::create($request, $this);

        return redirect('user/proyectosusers');
    }

    public function vistaCreate(){
        return view('user.proyectonew');
    }

    public function getFromGithub($url, &$return_code, &$output){

        $proyecto = session()->get('selected_project');
        //PRUEBA
        //$proyecto->repositorio = 'https://google.com/jph12/crisantema';
        //FN PRUEBA
        $repository = explode('/', $proyecto->repositorio);

        if (count($repository) != 5){ $return_code = 'repositorio_invalido'; return; }

        $url_aux = 'https://api.github.com/repos/' . $repository[3] . '/' . $repository[4];

        if ($url == 'commits'){ $url_aux = $url_aux . '/commits'; }
        else if ($url == 'contributors'){ $url_aux = $url_aux . '/stats/contributors'; }
        else if ($url == 'frecuencia_dia'){ $url_aux = $url_aux . '/stats/commit_activity'; }
        else if ($url == 'frecuencia_hora'){ $url_aux = $url_aux . '/stats/punch_card'; }

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url_aux);
        curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.8.1.13) Gecko/20080311 Firefox/2.0.0.13');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_USERPWD, 'jph11:Passwordprueba123');

        $ch = curl_exec($ch);

        $output = json_decode($ch, true);

        if (array_key_exists('message', $output)){ $output = array(); $return_code = 'repositorio_invalido'; return; }
    }

    public function getCommits(){

        $url = 'commits';
        $return_code = null;
        $output = array();

        $this->getFromGithub($url, $return_code, $output);
        //print_r($output);

        $commits = array();

        foreach ($output as $commit){

            //$key = DateTime::createFromFormat('Y-m-d H:i:s', $commit['commit']['author']['date']);
            $date = new DateTime($commit['commit']['author']['date']);
            //$key = $date->format('d M Y H i s');

            // Diferencia de tiempo
            $diferencia = 0;
            $unidad = '';

            $this->hace($date, $diferencia, $unidad);

            $datos = array();
            $datos['tipo'] = 'commit';
            $datos['fecha'] = $date;
            $datos['dia_concreto'] = $date->format('d M Y');
            $datos['commiter'] = $commit['committer']['login'];
            $datos['commiter_url'] = $commit['committer']['html_url'];
            $datos['commit_header'] = 'ha realizado un commit';
            $datos['commit_body'] = $commit['commit']['message'];
            $datos['diferencia'] = 'hace ' . $diferencia . ' ' . $unidad;
            $datos['html_url'] = $commit['html_url'];
            /*array_push($datos, $commit['committer']['login']);
            array_push($datos, 'ha realizado un commit');
            array_push($datos, $commit['commit']['message']);
            array_push($datos, 'hace ' . $diferencia . ' ' . $unidad);
            array_push($datos, $commit['html_url']);*/

            array_push($commits, $datos);
        }

        //curl_close($ch);

        return $commits;
    }

    public static function getHistorico(){

        $eventos = array();
        $sprints = Sprint::where('proyecto_id', session()->get('selected_project')->id)->get();

        foreach ($sprints as $sprint){

            $requisitos_aux = Requisito::where('sprint_id', $sprint->id)->with('modificacions')->get();
            // Append a requisitos

            foreach ($requisitos_aux as $requisito){

                foreach ($requisito->modificacions as $modificacion){

                    $datos = array();
                    $fecha = DateTime::createFromFormat('d/m/Y H:i:s', $modificacion->fecha);
                    //$fecha = new DateTime($modificacion->fecha);

                     // Diferencia de tiempo
                    $diferencia = 0;
                    $unidad = '';

                    ProyectosController::hace($fecha, $diferencia, $unidad);

                    $datos['tipo'] = 'modificacion';
                    $datos['fecha'] = $fecha;
                    $datos['dia_concreto'] = $fecha->format('d M Y');
                    $datos['diferencia'] = 'hace ' . $diferencia . ' ' . $unidad;
                    $datos['requisito_nombre'] = $requisito->nombre;
                    $datos['icon'] = "fa fa-user bg-aqua";
                    $datos['sprint_id'] = $sprint->id;
                    $datos['id'] = $requisito->id;

                    if ($modificacion->tipo == "add_user"){

                        $datos['icon'] = "fa fa-user-plus bg-green";

                        $mensaje = explode(':', $modificacion->mensaje);

                        if ($mensaje[0] == $mensaje[1]){

                            $datos['mensaje'] = '<b>' . $mensaje[0] . '</b> se ha unido al requisito';
                        }
                        else {

                            $datos['mensaje'] = '<b>' . $mensaje[0] . '</b> ha vinculado a <b>' . $mensaje[1] . '</b> al requisito';
                        }
                    }
                    else if ($modificacion->tipo == "delete_user"){

                        $datos['icon'] = "fa fa-user-times bg-yellow";

                        $mensaje = explode(':', $modificacion->mensaje);

                        if ($mensaje[0] == $mensaje[1]){

                            $datos['mensaje'] = '<b>' . $mensaje[0] . '</b> se ha desvinculado del requisito';
                        }
                        else {

                            $datos['mensaje'] = '<b>' . $mensaje[0] . '</b> ha desvinculado a <b>' . $mensaje[1] . '</b> del requisito';
                        }
                    }
                    else if ($modificacion->tipo == "edit_title"){

                        $exploded1 = explode(':', $modificacion->mensaje);
                        $author = $exploded1[0];
                        $aux = explode(';', $exploded1[1]);
                        $antiguo = $aux[0];
                        $nuevo = $aux[1];

                        $datos['mensaje'] = '<b>' . $author . '</b> ha modificado el título del requisito de \'' . $antiguo . '\' a \'' . $nuevo . '\'';
                    }
                    else if ($modificacion->tipo == "edit_description"){

                        $datos['icon'] = 'fa fa-edit bg-green';

                        $exploded1 = explode(':', $modificacion->mensaje);
                        $author = $exploded1[0];
                        $aux = explode(';', $exploded1[1]);
                        $antiguo = $aux[0];
                        $nuevo = $aux[1];

                        $datos['mensaje'] = '<b>' . $author . '</b> ha modificado la descripción del requisito de \'' . $antiguo . '\' a \'' . $nuevo . '\'';
                    }
                    else if ($modificacion->tipo == "edit_fecha_fin_estimada"){

                        $datos['icon'] = 'fa fa-calendar-times-o bg-yellow';

                        $exploded1 = explode(':', $modificacion->mensaje);
                        $author = $exploded1[0];
                        $aux = explode(';', $exploded1[1]);
                        $antiguo = $aux[0];
                        $nuevo = $aux[1];

                        $datos['mensaje'] = '<b>' . $author . '</b> ha modificado la fecha de finalización estimada del requisito de \'' . $antiguo . '\' a \'' . $nuevo . '\'';
                    }
                    else if ($modificacion->tipo == "edit_state"){

                        $datos['icon'] = 'fa fa-exchange bg-green';

                        $exploded1 = explode(':', $modificacion->mensaje);
                        $author = $exploded1[0];
                        $aux = explode(';', $exploded1[1]);
                        $antiguo = $aux[0];
                        $nuevo = $aux[1];

                        $datos['mensaje'] = '<b>' . $author . '</b> ha modificado el estado del requisito de \'' . $antiguo . '\' a \'' . $nuevo . '\'';
                    }
                    else {
                        $datos['icon'] = 'fa fa-cubes bg-red';

                        $datos['mensaje'] = '<b>' . $modificacion->mensaje . '</b> ha realizado múltiples modificaciones sobre el requisito';
                    }

                    array_push($eventos, $datos);
                }
            }
        }

        return $eventos;
    }

    public static function hace($date, &$diferencia, &$unidad){

        // Diferencia de tiempo
        //$timezone = new DateTimeZone('Europe/Madrid');
        //$date->setTimezone($timezone);
        $fecha_actual = new DateTime('NOW');
        $diff = $date->diff($fecha_actual);
        $diferencia = 0;
        $unidad = '';
        //$diff = abs($date->getTimeStamp() - $fecha_actual->getTimeStamp());

        // Años
        if ($diff->y > 0){

            $diferencia = $diff->y;
            $unidad = 'año';
        }
        // Meses
        else if ($diff->m > 0){

            $diferencia = $diff->m;
            $unidad = 'mes';
        }
        // Semanas
        else if (floor($diff->d / 7) > 0){

            $diferencia = floor($diff->d / 7);
            $unidad = 'semana';
        }
        // Días
        else if ($diff->d > 0){

            $diferencia = $diff->d;
            $unidad = 'día';
        }
        // Horas
        else if ($diff->h > 0){

            $diferencia = $diff->h;
            $unidad = 'hora';
        }
        // Minutos
        else if ($diff->i > 0){

            $diferencia = $diff->i;
            $unidad = 'minuto';
        }
        // Segundos
        else {

            $diferencia = $diff->s;
            $unidad = 'segundo';
        }

        if ($diferencia > 1){

            if ($unidad == 'mes'){

                $unidad = $unidad . 'es';
            }
            else {

                $unidad = $unidad . 's';
            }
        }
    }

    function cmp($a, $b){

        return $a['fecha'] < $b['fecha'];
    }

    public function actividad($id = null){

        $historico = ProyectosController::getHistorico();
        $commits = $this->getCommits();

        $eventos = array_merge($historico, $commits);
        usort($eventos, array($this, "cmp"));

        $aux = null;

        foreach ($eventos as &$evento){

            if ($evento['dia_concreto'] == $aux){

                $evento['show'] = false;
            }
            else {

                $evento['show'] = true;
            }

            $aux = $evento['dia_concreto'];
        }
        
        return view('user.actividad', ['eventos' => $eventos]);
    }

    public function graficos_requisitos($id = null){

        $sprints = Sprint::where('proyecto_id', session()->get('selected_project')->id)->get();
        $requisitos = array();

        foreach ($sprints as $sprint){

            $requisitos_aux = Requisito::where('sprint_id', $sprint->id)->get();

            foreach ($requisitos_aux as $requisito_aux){

                array_push($requisitos, $requisito_aux);
            }

        }

        //var_dump($requisitos);

        $usuarios = array();

        foreach ($requisitos as $requisito){

            foreach ($requisito->users as $user){

                $key = $user->name . ' ' . $user->apellidos;

                if (array_key_exists($key, $usuarios)){

                    $usuarios[$key] += 1;
                }
                else {

                    $usuarios[$key] = 1;
                }

            }
        }

        //var_dump($usuarios);
        
        return view('user.graficos_requisitos', ['usuarios' => $usuarios]);
    }

    public function graficos_commits($id = null){

        $url = 'contributors';
        $return_code = null;
        $output = array();

        $this->getFromGithub($url, $return_code, $output);

        $contributors = array();

        foreach ($output as $contributor){

            $contributors[$contributor['author']['login']] = $contributor['total'];
        }
        
        return view('user.graficos_commits', ['contributors' => $contributors, 'return_code' => $return_code]);
    }

    public function burndown_sprints($id = null){

        $sprints = Sprint::where('proyecto_id', session()->get('selected_project')->id)->with('requisitos')->get();
        $results = array();

        foreach ($sprints as $sprint){

            $requisitos = $sprint->requisitos;

            // Cálculo de días totales
            $fecha_inicio = DateTime::createFromFormat('d/m/Y', $sprint->fecha_inicio);
            $fecha_fin_estimada = DateTime::createFromFormat('d/m/Y', $sprint->fecha_fin_estimada);
            $fecha_dia_de_hoy = new DateTime('NOW');

            $dias = $fecha_inicio->diff($fecha_fin_estimada)->format('%a');

            // Cálculo de la cantidad de requisitos a realizar por sprint
            $requisitos_totales = count($requisitos);

            // Tamaño a sustraer en la gráfica de burndown estimado a medida que pasen los días
            $to_substract = $requisitos_totales / $dias;

            $burndown_estimado = array();
            $burndown_reales = array();
            //for ($i = 0; $i <= $dias; $i++){ $burndown_reales[$i] = $requisitos_totales; }

            $fechas = array();

            // Extracción de las horas reales y de las fechas
            $burndown_estimado_hora = $requisitos_totales;
            $fechai = DateTime::createFromFormat('d/m/Y', $fecha_inicio->format('d/m/Y'));

            for ($i = 0; $i <= $dias; $i++){

                array_push($burndown_estimado, $burndown_estimado_hora);
                $burndown_estimado_hora = abs(bcsub($burndown_estimado_hora, $to_substract, 4));

                // Contabilizamos los requisitos hechos pero solo hasta el día actual
                if ($fechai <= $fecha_dia_de_hoy){

                    $burndown_reales[$i] = $requisitos_totales;

                    foreach ($requisitos as $requisito){

                        if ($requisito->estado == 'Hecho'){

                            $requisito_fecha_fin = DateTime::createFromFormat('d/m/Y', $requisito->fecha_fin);
                            
                            if ($fechai >= $requisito_fecha_fin){

                                $burndown_reales[$i] -= 1;
                            }
                        }
                    }

                }

                array_push($fechas, $fechai->format('d-m-Y'));
                $fechai->add(new DateInterval('P1D'));
            }

            $results[$sprint->id] = array();
            $results[$sprint->id]['nombre'] = $sprint->nombre;
            $results[$sprint->id]['burndown_estimado'] = $burndown_estimado;
            $results[$sprint->id]['burndown_reales'] = $burndown_reales;
            $results[$sprint->id]['fechas'] = $fechas;
        }

        //var_dump($burndown_reales);
        //$fecha_inicio = new DateTime($sprint->fecha_inicio);

        return view('user.burndown_sprints', ['results' => $results]);
    }

    public function calendario($id = null){

        // Hay que sacar todos los requisitos del proyecto, no solo los de un determinado sprint
        $sprints = Sprint::where('proyecto_id', session()->get('selected_project')->id)->get();
        $requisitos = array();
        
        foreach ($sprints as $sprint){
            
            $requisitos_aux = Requisito::where('sprint_id', $sprint->id)->get();

            foreach ($requisitos_aux as $requisito_aux){

                array_push($requisitos, $requisito_aux);
            }
            //array_push($requisitos, $requisitos_aux);
        }

        $colores = array();
        array_push($colores, "#f56954");
        array_push($colores, "#f39c12");
        array_push($colores, "#0073b7");
        array_push($colores, "#00c0ef");
        array_push($colores, "#00a65a");
        array_push($colores, "#3c8dbc");

        foreach ($requisitos as $requisito){

            $requisito->fecha_inicio_split = explode('/', $requisito->fecha_inicio);

            $requisito->fecha_fin_estimada_split = explode('/', $requisito->fecha_fin_estimada);

            $requisito->color = $colores[rand(0, 5)];
        }

        return view('user.calendario', ['requisitos' => $requisitos]);
    }

    public function graficos_frecuencia_hora($id = null){

        $url = 'frecuencia_hora';
        $return_code = null;
        $output = array();

        $this->getFromGithub($url, $return_code, $output);

        $horas = array();

        for ($i = 0; $i < 24; $i++){

            $horas[$i] = 0;
        }

        foreach ($output as $commit){

            $horas[$commit['1']] += $commit['2'];
        }
        
        $dias = array();
        return view('user.graficos_frecuencia_hora', ['horas' => $horas, 'dias' => $dias, 'return_code' => $return_code]);

    }

    public function graficos_frecuencia_dia($id = null){

        $url = 'frecuencia_dia';
        $return_code = null;
        $output = array();

        $this->getFromGithub($url, $return_code, $output);
        $dias = array();

        for ($i = 0; $i < 7; $i++){

            $dias[$i] = 0;
        }

        foreach ($output as $commit){

            for ($i = 0; $i < 7; $i++){

                $dias[$i] += $commit['days'][$i];
            }
        }

        $aux = $dias[0];
        unset($dias[0]);
        array_push($dias, $aux);

        $horas = array();
        return view('user.graficos_frecuencia_dia', ['dias' => $dias, 'horas' => $horas, 'return_code' => $return_code]);
    }

}