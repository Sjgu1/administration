<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Redirect;

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

        $user = User::where('id', '1')->first();
        $proyecto = Proyecto::where('id', '1')->first();
        $rol = Rol::where('id', '1')->first();

        $proyectouser = new ProyectoUser();
        $proyectouser->user()->associate($user);
        $proyectouser->proyecto()->associate($proyecto);
        $proyectouser->rol()->dissociate();
        $proyectouser->rol()->associate($rol);
        $proyectouser->save();

        $user = User::where('id', '2')->first();
        $proyecto = Proyecto::where('id', '1')->first();
        $rol = Rol::where('id', '4')->first();

        $proyectouser = new ProyectoUser();
        $proyectouser->user()->associate($user);
        $proyectouser->proyecto()->associate($proyecto);
        $proyectouser->rol()->associate($rol);
        $proyectouser->save();

        $user = User::where('id', '3')->first();
        $proyecto = Proyecto::where('id', '1')->first();
        $rol = Rol::where('id', '2')->first();

        $proyectouser = new ProyectoUser();
        $proyectouser->user()->associate($user);
        $proyectouser->proyecto()->associate($proyecto);
        $proyectouser->rol()->associate($rol);
        $proyectouser->save();

        $user = User::where('id', '1')->first();
        $proyecto = Proyecto::where('id', '3')->first();
        $rol = Rol::where('id', '4')->first();

        $proyectouser = new ProyectoUser();
        $proyectouser->user()->associate($user);
        $proyectouser->proyecto()->associate($proyecto);
        $proyectouser->rol()->associate($rol);
        $proyectouser->save();

        $user = User::where('id', '3')->first();
        $proyecto = Proyecto::where('id', '2')->first();
        $rol = Rol::where('id', '3')->first();

        $proyectouser = new ProyectoUser();
        $proyectouser->user()->associate($user);
        $proyectouser->proyecto()->associate($proyecto);
        $proyectouser->rol()->associate($rol);
        $proyectouser->save();

        $user = User::where('id', '1')->first();
        $proyecto = Proyecto::where('id', '4')->first();
        $rol = Rol::where('id', '1')->first();

        $proyectouser = new ProyectoUser();
        $proyectouser->user()->associate($user);
        $proyectouser->proyecto()->associate($proyecto);
        $proyectouser->rol()->associate($rol);
        $proyectouser->save();
    }
}
