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


class ProyectosController extends Controller
{

    public function details($id){
        $proyecto = Proyecto::where('id', $id)->first();
        if($proyecto==null){
            return view('alerta_elemento',['slot'=> "No existe el elemento Proyecto: " .$id  ] );
        }else{
            return view('proyecto', ['proyecto' => $proyecto]);
        }
        
    }

    public function modify(Request $request){

        /*$this->validate($request, [
            'nombre' => ['string', 'min:3', 'max:20'],
            'descripcion' => ['string', 'min:3', 'max:65535'],
            'repositorio' => 'url | nullable'
        ]);*/

        $proyecto = Proyecto::where('id', $request->input('id'))->first();
        $proyecto->nombre = $request->input('nombre');
        $proyecto->descripcion = $request->input('descripcion');
        $proyecto->repositorio = $request->input('repositorio');
        $proyecto->fecha_inicio = $request->input('fecha_inicio');
        $proyecto->fecha_fin_estimada = $request->input('fecha_fin_estimada');

        $proyecto->save();
        return view('exito_elemento',['slot'=> "Se ha modificado el Proyecto: " .$proyecto->id  ] );

    }

    public function delete($id){

        $proyecto = Proyecto::where('id', $id)->first();
        $proyecto->delete();
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

        /*$this->validate($request, [
            'nombre' => ['string', 'min:3', 'max:20'],
            'descripcion' => ['string', 'min:3', 'max:65535'],
            'repositorio' => 'url | nullable'
        ]);*/

        $proyecto = new Proyecto();
        $proyecto->nombre = $request->input('nombre');
        $proyecto->descripcion = $request->input('descripcion');
        $proyecto->repositorio = $request->input('repositorio');
        $proyecto->fecha_inicio = $request->input('fecha_inicio');
        $proyecto->fecha_fin_estimada = $request->input('fecha_fin_estimada');

        $proyecto->save();

        $proyectoUser = new ProyectoUser();
        $user = User::where('id', Auth::id())->first();
        $rol = Rol::where('id', '1')->first();

        $proyectoUser->user()->associate($user->id);
        $proyectoUser->proyecto()->associate($proyecto->id);
        $proyectoUser->rol()->associate($rol->id);
        $proyectoUser->save();
        return redirect('user/proyectosusers');
    }

    public function getCommits(){

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'https://api.github.com/repos/jph11/crisantemo/commits');
        curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.8.1.13) Gecko/20080311 Firefox/2.0.0.13');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_USERPWD, 'jph11:Passwordprueba123');

        $output = json_decode(curl_exec($ch), true);

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

        curl_close($ch);

        return $commits;
    }

    public function getHistorico(){

        $eventos = array();
        $sprints = Sprint::where('proyecto_id', 4)->get();

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

                    $this->hace($fecha, $diferencia, $unidad);

                    $datos['tipo'] = 'modificacion';
                    $datos['fecha'] = $fecha;
                    $datos['dia_concreto'] = $fecha->format('d M Y');
                    $datos['diferencia'] = 'hace ' . $diferencia . ' ' . $unidad;
                    $datos['requisito_nombre'] = $requisito->nombre;
                    $datos['icon'] = "fa fa-user bg-aqua";
                    $datos['id'] = $requisito->id;

                    if ($modificacion->tipo == "add_user"){

                        $datos['icon'] = "fa fa-user-plus bg-green";

                        $mensaje = explode(':', $modificacion->mensaje);

                        if ($mensaje[0] == $mensaje[1]){

                            $datos['mensaje'] = $mensaje[0] . ' se ha unido al requisito';
                        }
                        else {

                            $datos['mensaje'] = $mensaje[0] . ' ha añadido a ' . $mensaje[1] . ' al requisito';
                        }
                    }
                    else if ($modificacion->tipo == "delete_user"){

                        $datos['icon'] = "fa fa-user-times bg-yellow";

                        $mensaje = explode(':', $modificacion->mensaje);

                        if ($mensaje[0] == $mensaje[1]){

                            $datos['mensaje'] = $mensaje[0] . ' se ha desvinculado del requisito';
                        }
                        else {

                            $datos['mensaje'] = $mensaje[0] . ' ha desvinculado a ' . $mensaje[1] . ' del requisito';
                        }
                    }
                    else if ($modificacion->tipo == "edit_title"){

                        $datos['mensaje'] = $modificacion->mensaje . ' ha modificado el título de tal a tal';
                    }
                    else if ($modificacion->tipo == "edit_description"){

                        $datos['mensaje'] = $modificacion->mensaje . ' ha modificado la descripción';
                    }
                    else if ($modificacion->tipo == "edit_fecha_fin_estimada"){

                        $datos['mensaje'] = "Sergio tal tal ha modificado a Jesús";
                    }
                    else if ($modificacion->tipo == "edit_state"){

                        $datos['mensaje'] = "Sergio tal tal ha modificado a Jesús";
                    }

                    array_push($eventos, $datos);
                }
            }
        }

        return $eventos;
    }

    public function hace($date, &$diferencia, &$unidad){

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

        $historico = $this->getHistorico();
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

        $requisitos = Requisito::with('users')->get();

        //var_dump($requisitos);

        $usuarios = array();

        foreach ($requisitos as $requisito){

            foreach ($requisito->users as $user){

                if (array_key_exists($user->username, $usuarios)){

                    $usuarios[$user->username] += 1;
                }
                else {

                    $usuarios[$user->username] = 1;
                }

            }
        }

        //var_dump($usuarios);
        
        return view('user.graficos_requisitos', ['usuarios' => $usuarios]);
    }

    public function graficos_commits($id = null){

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'https://api.github.com/repos/jph11/crisantemo/stats/contributors');
        curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.8.1.13) Gecko/20080311 Firefox/2.0.0.13');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_USERPWD, 'jph11:Passwordprueba123');

        $output = json_decode(curl_exec($ch), true);
        $contributors = array();

        foreach ($output as $contributor){

            $contributors[$contributor['author']['login']] = $contributor['total'];
        }

        //var_dump($contributors);
        //var_dump(json_decode($output, true));

        curl_close($ch);

        //var_dump($contributors);
        
        return view('user.graficos_commits', ['contributors' => $contributors]);
    }

    public function burndown_sprints($id = null){

        $sprint = Sprint::where('id', 13)->first();
        $requisitos = $sprint->requisitos;

        // Cálculo de días totales
        $fecha_inicio = DateTime::createFromFormat('d/m/Y', $sprint->fecha_inicio);
        $fecha_fin_estimada = DateTime::createFromFormat('d/m/Y', $sprint->fecha_fin_estimada);
        $dias = $fecha_inicio->diff($fecha_fin_estimada)->format('%a');

        // Cálculo de horas totales estimadas de acuerdo a la suma de todos los requisitos
        $horas_totales = 0;

        foreach ($requisitos as $requisito){

            $fecha_inicio_requisito = DateTime::createFromFormat('d/m/Y', $requisito->fecha_inicio);
            $fecha_fin_estimada_requisito = DateTime::createFromFormat('d/m/Y', $requisito->fecha_fin_estimada);

            //var_dump($fecha_inicio_requisito->diff($fecha_fin_estimada_requisito)->format('%a'));
            $horas_totales += $fecha_inicio_requisito->diff($fecha_fin_estimada_requisito)->format('%a') * 8;
        }

        // Tamaño a sustraer en la gráfica de burndown estimado a medida que pasen los días
        $to_substract = $horas_totales / $dias;

        $burndown_estimado = array();
        $burndown_reales = array();
        for ($i = 0; $i <= $dias; $i++){ $burndown_reales[$i] = $horas_totales; }

        $fechas = array();

        // Extracción de las horas reales y de las fechas
        $burndown_estimado_hora = $horas_totales;
        $fecha_actual = DateTime::createFromFormat('d/m/Y', $fecha_inicio->format('d/m/Y'));

        for ($i = 0; $i <= $dias; $i++){

            array_push($burndown_estimado, $burndown_estimado_hora);
            $burndown_estimado_hora = abs(bcsub($burndown_estimado_hora, $to_substract, 4));

            //if ($fecha_actual <= new DateTime('NOW')){

                foreach ($requisitos as $requisito){

                    if ($requisito->fecha_fin != null){

                        $fecha_aux = DateTime::createFromFormat('d/m/Y', $requisito->fecha_fin);

                        // Ha finalizado antes o en el día que estamos mirando
                        if ($fecha_aux <= $fecha_actual){

                            // Ha finalizado antes de lo estimado
                            $fecha_aux_estimada = DateTime::createFromFormat('d/m/Y', $requisito->fecha_fin_estimada);

                            if ($fecha_aux < $fecha_aux_estimada){

                                $burndown_reales[$i] -= DateTime::createFromFormat('d/m/Y', $requisito->fecha_inicio)->diff($fecha_aux_estimada)->format('%a') * 8;
                            }
                            // Ha finalizado el día estimado o posterior
                            else {

                                $burndown_reales[$i] -= DateTime::createFromFormat('d/m/Y', $requisito->fecha_inicio)->diff($fecha_aux)->format('%a') * 8;
                            }
                        }
                    }
                }

            /*}
            else {

                unset($burndown_reales[$i]);
            }*/

            array_push($fechas, $fecha_actual->format('d-m-Y'));
            $fecha_actual->add(new DateInterval('P1D'));
        }

        //var_dump($burndown_reales);
        //$fecha_inicio = new DateTime($sprint->fecha_inicio);

        return view('user.burndown_sprints', ['fechas' => $fechas, 'burndown_estimado' => $burndown_estimado, 'burndown_reales' => $burndown_reales]);
    }

    public function calendario($id = null){

        // Hay que sacar todos los requisitos del proyecto, no solo los de un determinado sprint
        $requisitos = Requisito::where('sprint_id', 13)->get();

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

    public function graficos_frecuencia($id = null){

        // Extracción de las horas con sus commits
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'https://api.github.com/repos/jph11/crisantemo/stats/punch_card');
        curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.8.1.13) Gecko/20080311 Firefox/2.0.0.13');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_USERPWD, 'jph11:Passwordprueba123');

        $output = json_decode(curl_exec($ch), true);
        $horas = array();

        for ($i = 0; $i < 24; $i++){

            $horas[$i] = 0;
        }

        foreach ($output as $commit){

            $horas[$commit['1']] += $commit['2'];
        }

        curl_close($ch);

        // Extracción de los días con sus commits
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'https://api.github.com/repos/jph11/crisantemo/stats/commit_activity');
        curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.8.1.13) Gecko/20080311 Firefox/2.0.0.13');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_USERPWD, 'jph11:Passwordprueba123');

        $output = json_decode(curl_exec($ch), true);
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

        curl_close($ch);
        
        return view('user.graficos_frecuencia', ['horas' => $horas, 'dias' => $dias]);

    }

}