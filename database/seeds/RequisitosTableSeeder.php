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

        $requisito = new Requisito(['nombre' => 'Crear Tablas', 'descripcion' => 'Realizacion de las tablas para la base de datos']);
        $sprint = Sprint::where('id', '1')->first();
        $requisito->sprint()->associate($sprint);
        $requisito->save();

        $requisito = new Requisito(['nombre' => 'Integridad referencial', 'descripcion' => 'Testear la integridad referencial de la base de datos']);
        $sprint = Sprint::where('id', '1')->first();
        $requisito->sprint()->associate($sprint);
        $requisito->save();

        $requisito = new Requisito(['nombre' => 'Layout', 'descripcion' => 'Crear layout para las vistas']);
        $sprint = Sprint::where('id', '1')->first();
        $requisito->sprint()->associate($sprint);
        $requisito->save();

        $requisito = new Requisito(['nombre' => 'Vista tablon', 'descripcion' => 'Crear y modelar una vista para el tablon']);
        $sprint = Sprint::where('id', '2')->first();
        $requisito->sprint()->associate($sprint);
        $requisito->save();

        $requisito = new Requisito(['nombre' => 'Controlador  tablon', 'descripcion' => 'Crear el controlador para la vista del tablon']);
        $sprint = Sprint::where('id', '2')->first();
        $requisito->sprint()->associate($sprint);
        $requisito->save();

        $requisito = new Requisito(['nombre' => 'Rutas', 'descripcion' => 'Ajustar el fichero de rutas y enlazar bien las funciones de los controladores']);
        $sprint = Sprint::where('id', '2')->first();
        $requisito->sprint()->associate($sprint);
        $requisito->save();

        $requisito = new Requisito(['nombre' => 'Responsive', 'descripcion' => 'Ajustar el responsive de las vistas para resoluciones mas grandes']);
        $sprint = Sprint::where('id', '3')->first();
        $requisito->sprint()->associate($sprint);
        $requisito->save();

        $requisito = new Requisito(['nombre' => 'Formulario requisitos', 'descripcion' => 'Formulario para crear un nuevo requisito']);
        $sprint = Sprint::where('id', '3')->first();
        $requisito->sprint()->associate($sprint);
        $requisito->save();

        $requisito = new Requisito(['nombre' => 'Borrar requisito', 'descripcion' => 'Realizar un borrado de requisitos en la base de datos']);
        $sprint = Sprint::where('id', '3')->first();
        $requisito->sprint()->associate($sprint);
        $requisito->save();

        $requisito = new Requisito(['nombre' => 'Añadir usuario', 'descripcion' => 'Hacer formulario para dar de alta un usuario']);
        $sprint = Sprint::where('id', '4')->first();
        $requisito->sprint()->associate($sprint);
        $requisito->save();

        $requisito = new Requisito(['nombre' => 'Baja usuario', 'descripcion' => 'Dar de baja un usuario de la base de datos']);
        $sprint = Sprint::where('id', '4')->first();
        $requisito->sprint()->associate($sprint);
        $requisito->save();

        $requisito = new Requisito(['nombre' => 'Correr', 'descripcion' => 'Correr muy rapido, lejos, lo más lejos posible, para demostrar que el mundo es redondo']);
        $sprint = Sprint::where('id', '4')->first();
        $requisito->sprint()->associate($sprint);
        $requisito->save();
        // A ver si borra
       // DB::table('proyectos')->where('nombre', 'Proyecto número 1')->delete();


    }
}
