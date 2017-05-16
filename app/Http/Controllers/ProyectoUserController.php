<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ProyectoUser;
use App\Rol;

class ProyectoUserController extends Controller
{

    public function userspublic($id = null){

        $rols = Rol::get();
        $proyecto_users = ProyectoUser::where('proyecto_id', 1)->with('user')->with('rol')->get();

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

        return view('user.users', ['proyecto_users' => $proyecto_users, 'rols' => $rols]);
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
