<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ProyectoUser;
use App\Rol;
use App\User;
use Auth;
use App\Permiso;
use App\Proyecto;
use App\ServiceLayer\RolServices;
use Mail;

class ProyectoUserController extends Controller
{

    public function __construct(){

        parent::__construct();

        $this->middleware('auth');
    }
    
    public function userspublic($id = null){

        $proyecto = '';
        $proyecto_users = '';
        $users = '';
        $rols = '';
        $proyecto = '';

        // Permisos
        $modificar_usuarios = '';
        $crear_sprint = '';
        $modificar_proyecto = '';
        $borrar_proyecto = '';
        $invitar_usuarios = '';
        // /Permisos

        RolServices::userspublic($proyecto, $proyecto_users, $users, $rols, $modificar_usuarios, $crear_sprint, $modificar_proyecto, $borrar_proyecto, $invitar_usuarios);

        return view('user.users', ['proyecto_users' => $proyecto_users, 'users' => $users, 'rols' => $rols, 'proyecto' => $proyecto, 'modificar_usuarios' => $modificar_usuarios, 'crear_sprint' => $crear_sprint, 'modificar_proyecto' => $modificar_proyecto, 'borrar_proyecto' => $borrar_proyecto, 'invitar_usuarios' => $invitar_usuarios]);
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

        if ($user_id == Auth::user()->id){

            session()->forget('selected_project');
            return redirect('/user/proyectosusers')->with('message', 'Te has desvinculado del proyecto correctamente')->with('exito', 'eliminado');
        }

        return redirect()->route('userspublic');
    }

    public function create(Request $request){

        $proyecto_id = session()->get('selected_project')->id;
        $all_users = User::get();
        $user_id = 1;
        $this->validate($request, [
            'user_name' => ['string', 'min:3']
        ]);

        foreach ($all_users as $aux_user){

            $nombre_completo = $aux_user->name . ' ' . $aux_user->apellidos;

            if ($nombre_completo == $request->input('user_name')){

                $user_id = $aux_user->id;
            }
        }

        $user = User::where('id', $user_id)->first();
        $user_id = $user->id;
        $rol_id = $request->input('rol_id');
        if($rol_id ==null){
            return redirect()->back()->with('message', 'No se ha seleccionado rol');
        }

        $proyecto_user = new ProyectoUser();
        $proyecto_user->proyecto()->associate($proyecto_id);
        $proyecto_user->user()->associate($user_id);
        $proyecto_user->rol()->associate($rol_id);

        $exito= $proyecto_user->save();

        $proyecto = Proyecto::where('id', $proyecto_id)->first();
        

        $user2 = User::where('id', $user_id)->first();

        $data = "Mensaje de Crisantemo. Has sido invitado al proyecto: " .
        "Nombre: ". $proyecto->nombre ;

       Mail::raw($data, function ($message) {
            $message->to('crisantemo.dss.2017@gmail.com', 'Crisantemo');
        });
        if($exito){
                return redirect()->back()->with('message', 'Se ha agregado un usuario')->with('exito', 'exito');
        }else{
                return redirect()->back()->with('message', 'No se ha podido agregar al usuario, compruebe la información');
        }

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
