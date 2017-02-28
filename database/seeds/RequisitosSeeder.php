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
        //DB::table('requisitos')->delete();
        // Añadimos una entrada a esta tabla
        DB::table('requisitos')->insert([
        'id' => '1',
        'idProyecto'=>'1',
        'idSprint'=>'1',
        'tiempoFinEstimado' => 'nunca',
        ]);
        DB::table('requisitos')->insert([
        'id' => '2',
        'idProyecto'=>'1',
        'idSprint'=>'2',
        'tiempoFinEstimado' => 'nunca',
        ]);
        DB::table('requisitos')->insert([
        'id' => '3',
        'idProyecto'=>'2',
        'idSprint'=>'1',
        'tiempoFinEstimado' => 'nunca',
        ]);
        DB::table('requisitos')->insert([
        'id' => '4',
        'idProyecto'=>'3',
        'idSprint'=>'1',
        'tiempoFinEstimado' => 'nunca',
        ]);

    }
}
