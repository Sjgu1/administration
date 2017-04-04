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

        $requisito1 = Requisito::where('id', '1')->first();
        $requisito2 = Requisito::where('id', '2')->first();
        $requisito3 = Requisito::where('id', '3')->first();
        $requisito4 = Requisito::where('id', '4')->first();
        $requisito5 = Requisito::where('id', '5')->first();
        $requisito6 = Requisito::where('id', '6')->first();
        $requisito7 = Requisito::where('id', '7')->first();
        $requisito8 = Requisito::where('id', '8')->first();
        $requisito10 = Requisito::where('id', '10')->first();

        $requisito2->requisitos()->attach($requisito1->id);
        $requisito3->requisitos()->attach($requisito5->id);
        $requisito4->requisitos()->attach($requisito5->id);
        $requisito6->requisitos()->attach($requisito10->id);
        $requisito7->requisitos()->attach($requisito10->id);
        $requisito8->requisitos()->attach($requisito10->id);
        $requisito10->requisitos()->attach($requisito1->id);
    }
}
