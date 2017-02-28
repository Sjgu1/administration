<?php

use Illuminate\Database\Seeder;

class ProyectosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        // Borramos los datos de la tabla
        //DB::table('requisitos')->delete();
        //DB::table('sprints')->delete();
        //DB::table('proyectos')->delete();

        // Añadimos una entrada a esta tabla
       DB::table('proyectos')->insert([
        'fechaInicio' => time(),
        'fechaFin' => time(),
        'nombre' => 'proyecto1',
        'descripcion' => 'descripcion proecto1' ]);

         DB::table('proyectos')->insert([
        'fechaInicio' => time(),
        'fechaFin' => time(),
        'nombre' => 'proyecto2',
        'descripcion' => 'descripcion proecto2' ]);

         DB::table('proyectos')->insert([
        'fechaInicio' => time(),
        'fechaFin' => time(),
        'nombre' => 'proyecto3',
        'descripcion' => 'descripcion proecto3' ]);

         DB::table('proyectos')->insert([
        'fechaInicio' => time(),
        'fechaFin' => time(),
        'nombre' => 'proyecto4',
        'descripcion' => 'descripcion proecto4' ]);

         DB::table('proyectos')->insert([
        'fechaInicio' => time(),
        'fechaFin' => time(),
        'nombre' => 'proyecto5',
        'descripcion' => 'descripcion proecto5' ]);

         DB::table('proyectos')->insert([
        'fechaInicio' => time(),
        'fechaFin' => time(),
        'nombre' => 'proyecto6',
        'descripcion' => 'descripcion proecto6' ]);
        
    

        
    }
}
