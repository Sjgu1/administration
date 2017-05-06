<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Input;
use App\Proyecto;
use App\Sprint;
use DateTime;
use DateInterval;
use App\ProyectoUser;
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

        $this->validate($request, [
            'nombre' => ['string', 'min:3', 'max:20'],
            'descripcion' => ['string', 'min:3', 'max:65535'],
            'repositorio' => 'url | nullable'
        ]);

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

        $this->validate($request, [
            'nombre' => ['string', 'min:3', 'max:20'],
            'descripcion' => ['string', 'min:3', 'max:65535'],
            'repositorio' => 'url | nullable'
        ]);

        $proyecto = new Proyecto();
        $proyecto->nombre = $request->input('nombre');
        $proyecto->descripcion = $request->input('descripcion');
        $proyecto->repositorio = $request->input('repositorio');
        $proyecto->fecha_inicio = $request->input('fecha_inicio');
        $proyecto->fecha_fin_estimada = $request->input('fecha_fin_estimada');

        $proyecto->save();
        return redirect('proyectos');
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

}