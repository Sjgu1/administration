<?php

namespace App\ServiceLayer;

use App\Http\Controllers\ProyectosController;
use Illuminate\Support\Facades\DB;
use App\ProyectoUser;
use App\Rol;
use App\User;
use Auth;
use App\Permiso;

class RolServices {

    public static function userspublic(&$proyecto, &$proyecto_users, &$users, &$rols, &$modificar_usuarios, &$crear_sprint, &$modificar_proyecto, &$borrar_proyecto, &$invitar_usuarios){

        $proyecto = session()->get('selected_project');
        if($proyecto==null){

            return redirect()->back()->with('message', 'Ningún proyecto seleccionado');
        }

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
        $borrar_proyecto = ProyectosController::permisoChecker('borrar_proyecto');
        $invitar_usuarios = ProyectosController::permisoChecker('invitar_usuarios');
        // /Permisos
        
    }
}