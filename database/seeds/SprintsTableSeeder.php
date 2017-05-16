<?php

use Illuminate\Database\Seeder;
use App\Sprint;
use App\Proyecto;

class SprintsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         //Team::all()->delete();
        DB::table('sprints')->delete();

        $sprint = new Sprint([
            'nombre' => 'Planificacion del proyecto',
            'descripcion' => 'Diseño de diagramas de casos de uso. Diagrama de arquitectura y análisis UML. Planificación de las pruebas',
            'fecha_inicio' => '29/07/2017',
            'fecha_fin_estimada' => '20/20/2017'
        ]);
        $proyecto = Proyecto::where('nombre', 'GIMP')->first();
        $sprint->proyecto()->associate($proyecto);
        $sprint->save();

        $sprint = new Sprint([
            'nombre' => 'Diseño del proyecto',
            'descripcion' => 'Diseño de diagramas de flujo, diagramas de actividad, secuencia y colaboración',
            'fecha_inicio' => '29/07/2017',
            'fecha_fin_estimada' => '20/20/2017'
        ]);
        $proyecto = Proyecto::where('nombre', 'GIMP')->first();
        $sprint->proyecto()->associate($proyecto);
        $sprint->save();

        $sprint = new Sprint([
            'nombre' => 'Implementacion del proyecto',
            'descripcion' => 'Desarrollo de la aplicación. Desarrollo de los test unitarios.',
            'fecha_inicio' => '29/07/2017',
            'fecha_fin_estimada' => '20/20/2017'
        ]);
        $proyecto = Proyecto::where('nombre', 'GIMP')->first();
        $sprint->proyecto()->associate($proyecto);
        $sprint->save();

        $sprint = new Sprint([
            'nombre' => 'Fase de testeo',
            'descripcion' => 'Ejecución y puesta en marcha de la aplicación. Ejecución de los test.',
            'fecha_inicio' => '29/07/2017',
            'fecha_fin_estimada' => '20/20/2017'
        ]);
        $proyecto = Proyecto::where('nombre', 'JIRA')->first();
        $sprint->proyecto()->associate($proyecto);
        $sprint->save();

        $sprint = new Sprint([
            'nombre' => 'Planificacion del proyecto',
            'descripcion' => 'Diseño de diagramas de casos de uso. Diagrama de arquitectura y análisis UML. Planificación de las pruebas',
            'fecha_inicio' => '29/07/2017',
            'fecha_fin_estimada' => '20/20/2017'
        ]);
        $proyecto = Proyecto::where('nombre', 'JIRA')->first();
        $sprint->proyecto()->associate($proyecto);
        $sprint->save();

        $sprint = new Sprint([
            'nombre' => 'Diseño del proyecto',
            'descripcion' => 'Diseño de diagramas de flujo, diagramas de actividad, secuencia y colaboración',
            'fecha_inicio' => '29/07/2017',
            'fecha_fin_estimada' => '20/20/2017'
        ]);
        $proyecto = Proyecto::where('nombre', 'JIRA')->first();
        $sprint->proyecto()->associate($proyecto);
        $sprint->save();

        $sprint = new Sprint([
            'nombre' => 'Implementacion',
            'descripcion' => 'Desarrollo de la aplicación. Desarrollo de los test unitarios.',
            'fecha_inicio' => '29/07/2017',
            'fecha_fin_estimada' => '20/20/2017'
        ]);
        $proyecto = Proyecto::where('nombre', 'JIRA')->first();
        $sprint->proyecto()->associate($proyecto);
        $sprint->save();

        $sprint = new Sprint([
            'nombre' => 'Fase de testeo',
            'descripcion' => 'Ejecución y puesta en marcha de la aplicación. Ejecución de los test.',
            'fecha_inicio' => '29/07/2017',
            'fecha_fin_estimada' => '20/20/2017'
        ]);
        $proyecto = Proyecto::where('nombre', 'Bootstrap')->first();
        $sprint->proyecto()->associate($proyecto);
        $sprint->save();

        $sprint = new Sprint([
            'nombre' => 'Planificacion del proyecto',
            'descripcion' => 'Diseño de diagramas de casos de uso. Diagrama de arquitectura y análisis UML. Planificación de las pruebas',
            'fecha_inicio' => '29/07/2017',
            'fecha_fin_estimada' => '20/20/2017'
        ]);
        $proyecto = Proyecto::where('nombre', 'Bootstrap')->first();
        $sprint->proyecto()->associate($proyecto);
        $sprint->save();

        $sprint = new Sprint([
            'nombre' => 'Diseño del proyecto',
            'descripcion' => 'Diseño de diagramas de flujo, diagramas de actividad, secuencia y colaboración',
            'fecha_inicio' => '29/07/2017',
            'fecha_fin_estimada' => '20/20/2017'
        ]);
        $proyecto = Proyecto::where('nombre', 'Bootstrap')->first();
        $sprint->proyecto()->associate($proyecto);
        $sprint->save();

        $sprint = new Sprint([
            'nombre' => 'Implementacion',
            'descripcion' => 'Desarrollo de la aplicación. Desarrollo de los test unitarios.',
            'fecha_inicio' => '29/07/2017',
            'fecha_fin_estimada' => '20/20/2017'
        ]);
        $proyecto = Proyecto::where('nombre', 'Bootstrap')->first();
        $sprint->proyecto()->associate($proyecto);
        $sprint->save();

        $sprint = new Sprint([
            'nombre' => 'Fase de testeo',
            'descripcion' => 'Ejecución y puesta en marcha de la aplicación. Ejecución de los test.',
            'fecha_inicio' => '29/07/2017',
            'fecha_fin_estimada' => '20/20/2017'
        ]);
        $proyecto = Proyecto::where('nombre', 'Bootstrap')->first();
        $sprint->proyecto()->associate($proyecto);
        $sprint->save();

        $sprint = new Sprint([
            'nombre' => 'Sprint de prueba para Burndown',
            'descripcion' => 'Este es un sprint de prueba diseñado exclusivamente para burndown',
            'fecha_inicio' => '05/05/2017',
            'fecha_fin_estimada' => '20/05/2017'
        ]);
        $proyecto = Proyecto::where('nombre', 'Bootstrap')->first();
        $sprint->proyecto()->associate($proyecto);
        $sprint->save();
    }
}
