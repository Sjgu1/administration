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

        $requisito = new Requisito(['nombre' => 'Crear Tablas', 
        'descripcion' => 'Realizacion de las tablas para la base de datos',
        'fecha_inicio' => '03/03/2014',
        'fecha_fin_estimada' => '03/03/2018',
        'estado' => 'Por hacer']);
        $sprint = Sprint::where('id', '1')->first();
        $requisito->sprint()->associate($sprint);
        $requisito->save();

        $requisito = new Requisito(['nombre' => 'Integridad referencial',
        'descripcion' => 'Testear la integridad referencial de la base de datos', 
        'fecha_inicio' => '04/03/2014',
        'fecha_fin_estimada' => '03/03/2018',
        'fecha_fin' => '04/04/2018',
        'estado' => 'Hecho']);
        $sprint = Sprint::where('id', '1')->first();
        $requisito->sprint()->associate($sprint);
        $requisito->save();

        $requisito = new Requisito(['nombre' => 'Layout', 
        'descripcion' => 'Crear layout para las vistas', 
        'fecha_inicio' => '05/03/2014',
        'fecha_fin_estimada' => '03/03/2018',
        'estado' => 'Por hacer']);

        $sprint = Sprint::where('id', '1')->first();
        $requisito->sprint()->associate($sprint);
        $requisito->save();

        $requisito = new Requisito(['nombre' => 'Vista tablon', 
        'descripcion' => 'Crear y modelar una vista para el tablon', 
        'fecha_inicio' => '01/12/2012',
        'fecha_fin_estimada' => '03/03/2018',
        'estado' => 'Por hacer']);

        $sprint = Sprint::where('id', '2')->first();
        $requisito->sprint()->associate($sprint);
        $requisito->save();

        $requisito = new Requisito(['nombre' => 'Controlador  tablon', 
        'descripcion' => 'Crear el controlador para la vista del tablon', 
        'fecha_inicio' => '02/12/2012',
        'fecha_fin_estimada' => '03/03/2018',
        'estado' => 'Por hacer']);

        $sprint = Sprint::where('id', '2')->first();
        $requisito->sprint()->associate($sprint);
        $requisito->save();

        $requisito = new Requisito(['nombre' => 'Rutas', 
        'descripcion' => 'Ajustar el fichero de rutas y enlazar bien las funciones de los controladores', 
        'fecha_inicio' => '03/12/2012',
        'fecha_fin_estimada' => '03/03/2018',
        'estado' => 'Por hacer']);

        $sprint = Sprint::where('id', '2')->first();
        $requisito->sprint()->associate($sprint);
        $requisito->save();

        $requisito = new Requisito(['nombre' => 'Responsive', 
        'descripcion' => 'Ajustar el responsive de las vistas para resoluciones mas grandes', 
        'fecha_inicio' => '24/06/2017',
        'fecha_fin_estimada' => '03/03/2018',
        'estado' => 'Por hacer']);


        $sprint = Sprint::where('id', '3')->first();
        $requisito->sprint()->associate($sprint);
        $requisito->save();

        $requisito = new Requisito(['nombre' => 'Formulario requisitos', 
        'descripcion' => 'Formulario para crear un nuevo requisito', 
        'fecha_inicio' => '25/06/2017',
        'fecha_fin_estimada' => '03/03/2018',
        'estado' => 'Por hacer']);

        $sprint = Sprint::where('id', '3')->first();
        $requisito->sprint()->associate($sprint);
        $requisito->save();

        $requisito = new Requisito(['nombre' => 'Borrar requisito', 
        'descripcion' => 'Realizar un borrado de requisitos en la base de datos', 
        'fecha_inicio' => '26/06/2017',
        'fecha_fin_estimada' => '03/03/2018',
        'estado' => 'Por hacer']);

        $sprint = Sprint::where('id', '3')->first();
        $requisito->sprint()->associate($sprint);
        $requisito->save();

        $requisito = new Requisito(['nombre' => 'Añadir usuario', 
        'descripcion' => 'Hacer formulario para dar de alta un usuario', 
        'fecha_inicio' => '01/04/2010',
        'fecha_fin_estimada' => '03/03/2018',
        'estado' => 'Por hacer']);
        $sprint = Sprint::where('id', '4')->first();
        $requisito->sprint()->associate($sprint);
        $requisito->save();

        $requisito = new Requisito(['nombre' => 'Baja usuario', 
        'descripcion' => 'Dar de baja un usuario de la base de datos', 
        'fecha_inicio' => '01/04/201',
        'fecha_fin_estimada' => '03/03/2018',
        'estado' => 'Por hacer']);

        $sprint = Sprint::where('id', '4')->first();
        $requisito->sprint()->associate($sprint);
        $requisito->save();

        $requisito = new Requisito(['nombre' => 'Correr', 
        'descripcion' => 'Correr muy rapido, lejos, lo más lejos posible, para demostrar que el mundo es redondo', 
        'fecha_inicio' => '03/04/2012',
        'fecha_fin_estimada' => '03/03/2018',
        'estado' => 'Por hacer']);
        $sprint = Sprint::where('id', '4')->first();
        $requisito->sprint()->associate($sprint);
        $requisito->save();


        // Requisitos de prueba para burndown
        $requisito = new Requisito(['nombre' => 'Configurar base de datos', 
        'descripcion' => 'Requisito utilizado para la puesta a punto de la base de datos', 
        'fecha_inicio' => '05/05/2017',
        'fecha_fin_estimada' => '05/05/2017',
        'fecha_fin' => '05/05/2017',
        'estado' => 'Por hacer']);
        $sprint = Sprint::where('id', '13')->first();
        $requisito->sprint()->associate($sprint);
        $requisito->save();

        $requisito = new Requisito(['nombre' => 'Configurar plantilla', 
        'descripcion' => 'Requisito utilizado para la configuración de la plantilla', 
        'fecha_inicio' => '05/05/2017',
        'fecha_fin_estimada' => '07/05/2017',
        'fecha_fin' => '07/05/2017',
        'estado' => 'Hecho']);
        $sprint = Sprint::where('id', '13')->first();
        $requisito->sprint()->associate($sprint);
        $requisito->save();

        $requisito = new Requisito(['nombre' => 'Crear controladores', 
        'descripcion' => 'Requisito utilizado para la creación de los controladores', 
        'fecha_inicio' => '07/05/2017',
        'fecha_fin_estimada' => '20/05/2017',
        'fecha_fin' => '19/05/2017',
        'estado' => 'Por hacer']);
        $sprint = Sprint::where('id', '13')->first();
        $requisito->sprint()->associate($sprint);
        $requisito->save();

        // A ver si borra
       // DB::table('proyectos')->where('nombre', 'Proyecto número 1')->delete();


    }
}
