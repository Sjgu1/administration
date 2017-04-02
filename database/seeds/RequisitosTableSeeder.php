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

        $requisito = new Requisito(['nombre' => 'Requisito 1', 'descripcion' => 'Descripción requisito 1']);
        $sprint = Sprint::where('nombre', 'Sprint iteración 1')->first();
        $requisito->sprint()->associate($sprint);
        $requisito->save();

        $requisito = new Requisito(['nombre' => 'Requisito 2', 'descripcion' => 'Descripción requisito 2']);
        $sprint = Sprint::where('nombre', 'Sprint iteración 1')->first();
        $requisito->sprint()->associate($sprint);
        $requisito->save();

        // A ver si borra
       // DB::table('proyectos')->where('nombre', 'Proyecto número 1')->delete();


    }
}
