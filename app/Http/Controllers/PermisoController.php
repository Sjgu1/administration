<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Permiso;
use App\Proyecto;
use App\Sprint;

class PermisoController extends Controller
{

    public function search(){

        $permisos = Permiso::get();
        return view('permisos', compact('permisos'));
    }

    public function create(Request $request){

        $this->validate($request, [
            'nombre' => ['string', 'min:3', 'max:20'],
            'descripcion' => ['string', 'min:3', 'max:65535'],
        ]);

        $proyecto = new Permiso();
        $proyecto->nombre = $request->input('nombre');
        $proyecto->descripcion = $request->input('descripcion');

        $proyecto->save();
        return redirect('permisos');
    }

    public function details($id){

        $permiso = Permiso::where('id', $id)->first();
        if($permiso==null){
            return view('alerta_elemento',['slot'=> "No existe el elemento Permiso: " .$id  ] );
        }else{
            return view('permiso', ['permiso' => $permiso]);
        }
        
    }

    public function modify(Request $request){

        $this->validate($request, [
            'nombre' => ['string', 'min:3', 'max:20'],
            'descripcion' => ['string', 'min:3', 'max:65535'],
        ]);

        $permiso = Permiso::where('id', $request->input('id'))->first();
        $permiso->nombre = $request->input('nombre');
        $permiso->descripcion = $request->input('descripcion');

        $permiso->save();
        return view('exito_elemento',['slot'=> "Se ha modificado el Permiso: " . $permiso->id ]);

    }

    public function delete($id){

        $permiso = Permiso::where('id', $id)->first();
        $permiso->delete();
        return view('exito_elemento',['slot'=> "Se ha eliminado el Permiso: " .$permiso->id  ] );

    }
}
