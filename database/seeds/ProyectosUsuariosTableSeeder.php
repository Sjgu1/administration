<?php

use Illuminate\Database\Seeder;
use App\Usuario;
use App\Proyecto;

class ProyectosUsuariosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        //Player::all()->delete();
        DB::table('proyecto_usuario')->delete();

        $proyecto = new Proyecto(['nombre' => 'Proyecto con usuario 1']);
        $proyecto->save();

        $usuario = new Usuario(['nombre' => 'Usuario para linkar con proyecto']);
        $usuario->save();

        $usuario->proyectos()->attach($proyecto->id);
        
    }
}
