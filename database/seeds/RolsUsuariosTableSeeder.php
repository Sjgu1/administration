<?php

use Illuminate\Database\Seeder;
use App\Usuario;
use App\Rol;

class RolsUsuariosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $usuario = new Usuario(['nombre' => 'Prueba con rol 1']);

        $rol = new Rol(['nombre' => 'Rol prueba link con usuario 1']);
        $rol->save();

        $usuario->rol()->associate($rol->id);
        $usuario->save();


        $usuario = new Usuario(['nombre' => 'Prueba con rol 2']);

        $rol = new Rol(['nombre' => 'Rol prueba link con usuario 2']);
        $rol->save();

        $usuario->rol()->associate($rol->id);
        $usuario->save();

    }
}
