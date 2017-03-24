<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Proyecto;
use App\Rol;
use App\ProyectoUser;

class ProyectosUsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('proyecto_user')->delete();

        $user = new User(['nombre' => 'Usuario de prueba con tabla intermedia']);
        $user->save();

        $proyecto = new Proyecto(['nombre' => 'Proyecto de prueba con tabla intermedia']);
        $proyecto->save();

        $rol = new Rol(['nombre' => 'Rol de prueba con tabla intermedia']);
        $rol->save();

        $proyectouser = new ProyectoUser();
        
        $proyectouser->user()->associate($user->id);
        $proyectouser->proyecto()->associate($proyecto->id);
        $proyectouser->rol()->associate($rol->id);

        $proyectouser->save();
    }
}
