<?php

use Illuminate\Database\Seeder;
use App\Usuario;

class UsuariosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Player::all()->delete();
        DB::table('usuarios')->delete();

        $usuario = new Usuario(['nombre' => 'Jesús Perales Hernández']);
        $usuario->save();

        $usuario = new Usuario(['nombre' => 'Mario']);
        $usuario->save();

        $usuario = new Usuario(['nombre' => 'Sergio']);
        $usuario->save();

        $usuario = new Usuario(['nombre' => 'Laila']);
        $usuario->save();
    }
}
