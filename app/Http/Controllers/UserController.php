<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class UserController extends Controller
{

   public function search($field = null){
        $users = User::paginate(3);
        $valorNombre="";
        return view('users', compact(['users', 'valorNombre']));
    }

    public function filtrar(Request $request ){
        $name = $request->input('nombre');
        $paginate = 4;
        $page_no = isset($_GET['page']) ? $_GET['page'] : 1;
        $i = ($paginate * $page_no) - ($paginate - 1);
        $appends = array();
        

        $valorNombre="";
        if ($name!=null) {
            $users = User::get();
            foreach($users as $user){
                $nombreLeido = $user->nombre;
                $nombreLeido = strtolower($nombreLeido);
                $name = strtolower($name);
                if(strpos($nombreLeido, $name ) !== false){
                    $appends[]= $user->id;
                }
                    
            }
            $valorNombre=$name;
        }
        if ($name==null) {
            $users = User::get();
            foreach($users as $user){
                $appends[]= $user->id;
            }
        }
        
    
        $orden = $request->input('tipoOrdenacion');
        $ordenad = $request->input('campoOrdenado');
        if($ordenad == "id"){
            if($orden == "asc")
                $usersDevolver = User::whereIn('id', $appends)->orderBy('id','asc')->paginate(3);
            else
                $usersDevolver = User::whereIn('id', $appends)->orderBy('id','desc')->paginate(3);
        } else{
            if($orden == "asc")
                $usersDevolver = User::whereIn('id', $appends)->orderBy('nombre','asc')->paginate(3);
            else
                $usersDevolver = User::whereIn('id', $appends)->orderBy('nombre','desc')->paginate(3);
        }
        
        $users = $usersDevolver;

        return view('users', compact(['users','valorNombre']));
    
    }

    public function create(Request $request){

        $user = new User();
        $user->nombre = $request->input('nombre');
        $user->apellidos = $request->input('apellidos');
        $user->email = $request->input('email');
        $user->username = $request->input('username');

        $user->save();
        return redirect('users');
    }

     public function details($id){
        $user = User::where('id', $id)->first();
        if($user==null){
            return view('alerta_elemento',['slot'=> "No existe el elemento Usuario: " .$id  ] );
        }else{
            return view('user', ['user' => $user]);
        }
        
    }

    public function modify(Request $request){

        $user = User::where('id', $request->input('id'))->first();
        $user->nombre = $request->input('nombre');
        $user->apellidos = $request->input('apellidos');
        $user->username = $request->input('username');
        $user->email = $request->input('email');
        $user->password = $request->input('password');

        $user->save();
        return view('exito_elemento',['slot'=> "Se ha modificado el Usuario: " .$user->id  ] );

    }

    public function delete($id){

        $user = User::where('id', $id)->first();
        $user->delete();
        return view('exito_elemento',['slot'=> "Se ha eliminado el Usuario: " .$user->id  ] );

    }
}
