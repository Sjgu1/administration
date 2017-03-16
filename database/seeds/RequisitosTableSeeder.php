<?php

use Illuminate\Database\Seeder;
use App\Requisito;
use App\Sprint;

class RequisitosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        DB::table('requisitos')->delete();

        $requisito = new Requisito(['descripcion' => 'Requisito 2']);
        $sprint = Sprint::where('descripcion', 'Hola')->first();
        $requisito->sprint()->associate($sprint);
        $requisito->save();

        $requisito = new Requisito(['descripcion' => 'Requisito 3']);
        $sprint = Sprint::where('descripcion', 'Hola')->first();
        $requisito->sprint()->associate($sprint);
        $requisito->save();

        // A ver si borra
       // DB::table('proyectos')->where('nombre', 'Proyecto número 1')->delete();


    }
}
