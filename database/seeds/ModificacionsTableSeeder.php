<?php

use Illuminate\Database\Seeder;

use App\Modificacion;
use App\Requisito;

class ModificacionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $modificacion = new Modificacion([
            'tipo' => 'add_user',
            'mensaje' => 'Jesús Perales Hernández:Sergio Julio',
            'fecha' => '16/05/2017 06:00:00'
        ]);
        $requisito = Requisito::where('id', '13')->first();
        $modificacion->requisito()->associate($requisito);
        $modificacion->save();

        $modificacion = new Modificacion([
            'tipo' => 'delete_user',
            'mensaje' => 'Jesús Perales Hernández:Sergio Julio',
            'fecha' => '15/05/2017 13:20:13'
        ]);
        $requisito = Requisito::where('id', '14')->first();
        $modificacion->requisito()->associate($requisito);
        $modificacion->save();

    }
}
