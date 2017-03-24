<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Input;
use App\Proyecto;


class ProyectosController extends Controller
{
    public function search($field = null){
        $proyectos = Proyecto::paginate(3);
        return view('proyectos', compact('proyectos'));
    }
    public function filtrar(Request $request){
        $id = $request->input('id');
        $name = $request->input('nombre');
        $nombre = Proyecto::firstOrNew(array('id' => $id));
        $paginate = 4;
        $page_no = isset($_GET['page']) ? $_GET['page'] : 1;
        $i = ($paginate * $page_no) - ($paginate - 1);
        $appends = array();


    if ($id!=null) {
        $proyectosID = Proyecto::where('id',$id)->get();
        foreach($proyectosID as $proyecto){
            $appends[]= $proyecto->id;
        }
        
    } else {
        $nuevosProyectos = Proyecto::limit(-1);
    }
    if ($name!=null) {
        $proyectosNombre = Proyecto::where('nombre',$name)->get();
        foreach($proyectosNombre as $proyecto){
            $appends[]= $proyecto->id;
        }
    }
    if ($name==null && $id==null) {
       $proyectos = Proyecto::get();
       foreach($proyectos as $proyecto){
            $appends[]= $proyecto->id;
        }
    }

   /* if (Input::has('order_by') || Input::has('order')) {
        if (Input::has('order_by')) {
            $order_by = Input::get('order_by');
            $appends['order_by'] = Input::get('order_by');
        } else {
            $order_by = 'name';
        }
        if (Input::has('order')) {
            $order = Input::get('order');
            $appends['order'] = Input::get('order');
        } else {
            $order = 'asc';
        }
        $order = Input::get('order') ? Input::get('order') : 'asc';
        $newBrands->orderBy($order_by, $order);
    }else{
        $newBrands->orderBy('name', 'asc');
    }
*/
   // $proyectosDevolver= Proyectos::whereIn('id', $my_ids)
   // $proyectosDevolver= $nuevosProyectos->paginate(1);
    /* $queries = DB::getQueryLog();
      $last_query = end($queries);
      dd($last_query); */
      $proyectosDevolver = Proyecto::whereIn('id', $appends)->paginate(3);
      $proyectos = $proyectosDevolver;

    return view('proyectos', compact('proyectos'));
    
    }
}