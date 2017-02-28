<?php

use Illuminate\Database\Seeder;

class SprintsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        // Borramos los datos de la tabla
        //DB::table('sprints')->delete();
        // Añadimos una entrada a esta tabla
        DB::table('sprints')->insert([
        'idProyecto'=>'1',
        'id'=> '1',
        'fechaInicio' => time(),
        'fechaFin' => time(),
        'nombre' => 'pruebaSprint1',
        'descripcion' => 'Esto es una prueba' ]);

        DB::table('sprints')->insert([        
        'idProyecto'=>'1',
        'id'=> '2',
        'fechaInicio' => time(),
        'fechaFin' => time(),
        'nombre' => 'pruebaSprint2',
        'descripcion' => 'Esto es una prueba' ]);

        
    }
}
