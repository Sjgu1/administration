<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ProyectoUser;
use App\Rol;
use App\User;
use Auth;
use App\Permiso;

class ProyectoUserController extends Controller
{

    public function __construct(){

        parent::__construct();

        $this->middleware('auth');
    }
    public function userspublic($id = null){

        $proyecto = session()->get('selected_project');
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

        // Permisos
        $modificar_usuarios = ProyectosController::permisoChecker('modificar_usuarios');
        $crear_sprint = ProyectosController::permisoChecker('crear_sprint');
        $modificar_proyecto = ProyectosController::permisoChecker('modificar_proyecto');
        $invitar_usuarios = ProyectosController::permisoChecker('invitar_usuarios');
        // /Permisos

        //var_dump($modificar_usuarios);

        return view('user.users', ['proyecto_users' => $proyecto_users, 'users' => $users, 'rols' => $rols, 'proyecto' => $proyecto, 'modificar_usuarios' => $modificar_usuarios, 'crear_sprint' => $crear_sprint, 'modificar_proyecto' => $modificar_proyecto, 'invitar_usuarios' => $invitar_usuarios]);
    }

    public function modify(Request $request){

        // ESTE PUTO MÉTODO NO ESTÁ FUNCIONANDO Y NO ENTIENDO EL MOTIVO

        //var_dump($request);
        $proyecto_id = session()->get('selected_project')->id;
        $user = User::where('id',$request->input('user_id'))->first();
        $rol = Rol::where('id',$request->input('rol_id'))->first();


        $proyectouser = ProyectoUser::where('proyecto_id', $proyecto_id)->where('user_id', $user->id)->first();



        $proyecto = session()->get('selected_project');

        $proyectouser->rol()->dissociate();
        $proyectouser->rol()->associate($rol);
        
        $proyectouser->save();
        $proyectouser = ProyectoUser::where('proyecto_id', $proyecto_id)->where('user_id', $user->id)->first();

        return back()->withInput();
    }

    public function delete($proyecto_id, $user_id){

        //$proyecto_id = $request->input('proyecto_id');
        //$user_id = $request->input('user_id');

        $proyecto_user = ProyectoUser::where('proyecto_id', $proyecto_id)->where('user_id', $user_id)->first();
        $proyecto_user->rol()->dissociate();
        $proyecto_user->proyecto()->dissociate();
        $proyecto_user->user()->dissociate();
        $proyecto_user->delete();

        return redirect()->route('userspublic');
    }

    public function create(Request $request){

        $proyecto_id = session()->get('selected_project')->id;
        $all_users = User::get();
        $user_id = 1;

        foreach ($all_users as $aux_user){

            $nombre_completo = $aux_user->name . ' ' . $aux_user->apellidos;

            if ($nombre_completo == $request->input('user_name')){

                $user_id = $aux_user->id;
            }
        }

        $user = User::where('id', $user_id)->first();
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
