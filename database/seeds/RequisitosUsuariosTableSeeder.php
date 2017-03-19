<?php

use Illuminate\Database\Seeder;
use App\Usuario;
use App\Sprint;
use App\Requisito;

class RequisitosUsuariosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $requisito = new Requisito(['descripcion' => 'Requisito prueba con usuario']);
        $sprint = Sprint::where('descripcion', 'Hola')->first();
        $requisito->sprint()->associate($sprint);
        $requisito->save();

        $usuario = new Usuario(['nombre' => 'Usuario prueba con requisito']);
        $usuario->save();

        $usuario->requisitos()->attach($requisito->id);

    }
}
