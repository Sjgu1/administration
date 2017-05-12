<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ProyectoUser;

class ProyectoUserController extends Controller
{

    public function userspublic($id = null){

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

        return view('user.users', ['proyecto_users' => $proyecto_users]);
    }
}
