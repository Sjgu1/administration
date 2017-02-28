<?php

use Illuminate\Database\Seeder;

class RequisitosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(){
        DB::table('requisitos')->delete();
        // Añadimos una entrada a esta tabla
        DB::table('requisitos')->insert([
        'idProyecto'=>'1',
        'idSprint'=>'1',
        'tiempoFinEstimado' => 'nunca',
        ]);
        DB::table('requisitos')->insert([
        'idProyecto'=>'1',
        'idSprint'=>'2',
        'tiempoFinEstimado' => 'nunca',
        ]);
        DB::table('requisitos')->insert([
        'idProyecto'=>'2',
        'idSprint'=>'1',
        'tiempoFinEstimado' => 'nunca',
        ]);
        DB::table('requisitos')->insert([
        'idProyecto'=>'3',
        'idSprint'=>'1',
        'tiempoFinEstimado' => 'nunca',
        ]);

    }
}
