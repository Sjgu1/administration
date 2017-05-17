<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ProyectoUser;
use App\Rol;
use App\User;
use Auth;

class ProyectoUserController extends Controller
{

    public function __construct(){

        parent::__construct();

        $this->middleware('auth');
    }
    public function userspublic($id = null){

        $proyecto_users = ProyectoUser::where('proyecto_id', session()->get('selected_project')->id)->with('user')->with('rol')->get();
        $users_to_exclude = array();

        foreach ($proyecto_users as $proyecto_user){

            array_push($users_to_exclude, $proyecto_user->user->id);
        }

        $users = User::whereNotIn('id', $users_to_exclude)->get();

        $rols = Rol::get();

        foreach ($proyecto_users as $proyecto_user){

            if ($proyecto_user->rol->nombre == 'Administrador'){

                $proyecto_user->rol->label = 'label-danger';
            }
            else if ($proyecto_user->rol->nombre == 'Scrum Master'){

                $proyecto_user->rol->label = 'label-warning';
            }
            else if ($proyecto_user->rol->nombre == 'Desarrollador'){

                $proyecto_user->rol->label = 'label-primary';
            }
            else if ($proyecto_user->rol->nombre == 'Product Owner'){

                $proyecto_user->rol->label = 'label-success';
            }

            //var_dump($proyecto_user->rol);
        }

        return view('user.users', ['proyecto_users' => $proyecto_users, 'users' => $users, 'rols' => $rols]);
    }

    public function modify(Request $request){

        // ESTE PUTO MÉTODO NO ESTÁ FUNCIONANDO Y NO ENTIENDO EL MOTIVO

        //var_dump($request);
        $proyecto_id = session()->get('selected_project')->id;
        $user_id = $request->input('user_id');
        $rol_id = $request->input('rol_id');

        var_dump($proyecto_id);
        var_dump($user_id);
        var_dump($rol_id);

        $proyecto_user = ProyectoUser::where('proyecto_id', $proyecto_id)->where('user_id', $user_id)->first();
        $rol = Rol::where('id', $rol_id)->first();

        $proyecto_user->proyecto()->associate($proyecto_id);
        $proyecto_user->user()->associate($user_id);
        $proyecto_user->rol()->associate($rol->id);
        $proyecto_user->save();

        return redirect()->route('userspublic');
    }

    public function delete($proyecto_id, $user_id){

        //$proyecto_id = $request->input('proyecto_id');
        //$user_id = $request->input('user_id');

        $proyecto_user = ProyectoUser::where('proyecto_id', $proyecto_id)->where('user_id', $user_id)->first();
        $proyecto_user->delete();

        return redirect()->route('userspublic');
    }

    public function create(Request $request){

        $proyecto_id = session()->get('selected_project')->id;
        $user = User::where('name', $request->input('user_name'))->first();
        $user_id = $user->id;
        $rol_id = $request->input('rol_id');

        $proyecto_user = new ProyectoUser();
        $proyecto_user->proyecto()->associate($proyecto_id);
        $proyecto_user->user()->associate($user_id);
        $proyecto_user->rol()->associate($rol_id);

        $proyecto_user->save();

        return redirect()->route('userspublic');
    }

    public function invitation($id = null){

        $proyecto = $request->input('proyecto');
        $anfitrion_nombre = $request->input('anfitrion_nombre');
        $anfitrion_email = $request->input('anfitrion_email');
        $email = $request->input('email');
        $rol = $request->input('rol');

        $data = "Mensaje de Crisantemo. Has sido invitado al proyecto: " .
        "Nombre: ". $proyecto . "
        Con rol: ". $rol ."
        Por el usuario: " . $anfitrion_nombre . "
        Con correo: " . $anfitrion_email;

        Mail::raw($data, function ($message) {
            $message->to('crisantemo.dss.2017@gmail.com', 'Crisantemo');
        });

        return view('user.userspublic');
    }
}
