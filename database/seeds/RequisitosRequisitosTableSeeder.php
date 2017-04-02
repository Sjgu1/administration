<?php

use Illuminate\Database\Seeder;
use App\Requisito;
use App\Sprint;

class RequisitosRequisitosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('requisito_requisito')->delete();

        $sprint = Sprint::where('nombre', 'Sprint iteración 2')->first();

        $requisito1 = new Requisito(['descripcion' => 'Requisito prueba dependencia 1']);
        $requisito1->sprint()->associate($sprint);
        $requisito1->save();

        $requisito2 = new Requisito(['descripcion' => 'Requisito prueba dependencia 2']);
        $requisito2->sprint()->associate($sprint);
        $requisito2->save();

        /*$requisito2 = new Requisito(['descripcion' => 'Requisito prueba dependencia 2']);
        $requisito2->save();*/

        $requisito1->requisitos()->attach($requisito2->id);
        $requisito2->requisitos()->attach($requisito1->id);
    }
}
