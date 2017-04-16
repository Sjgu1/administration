<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class UserController extends Controller
{

    /*
   public function search($field = null){
        $users = User::paginate(8);
        $valorname="";
        return view('users', compact(['users', 'valorname']));
    }
    */

    public function search(){
         $users = User::get();
         return view('users', compact('users'));
     }

    public function filtrar(Request $request ){
        $name = $request->input('name');
        $paginate = 4;
        $page_no = isset($_GET['page']) ? $_GET['page'] : 1;
        $i = ($paginate * $page_no) - ($paginate - 1);
        $appends = array();
        

        $valorname="";
        if ($name!=null) {
            $users = User::get();
            foreach($users as $user){
                $nameLeido = $user->name;
                $nameLeido = strtolower($nameLeido);
                $name = strtolower($name);
                if(strpos($nameLeido, $name ) !== false){
                    $appends[]= $user->id;
                }
                    
            }
            $valorname=$name;
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
                $usersDevolver = User::whereIn('id', $appends)->orderBy('name','asc')->paginate(3);
            else
                $usersDevolver = User::whereIn('id', $appends)->orderBy('name','desc')->paginate(3);
        }
        
        $users = $usersDevolver;

        return view('users', compact(['users','valorname']));
    
    }

    public function create(Request $request){

        $user = new User();
        $user->name = $request->input('name');
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

        $this->validate($request, [
            'name' => ['string', 'min:3', 'max:20'],
            'apellidos' => ['string', 'min:3', 'max:50'],
            'email' => ['email'],
            'username' => ['string', 'min:3', 'max:20']
        ]);

        $user = User::where('id', $request->input('id'))->first();
        $user->name = $request->input('name');
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
