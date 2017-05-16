<?php

use Illuminate\Database\Seeder;
use App\Proyecto;

class ProyectosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        //Player::all()->delete();
        DB::table('proyectos')->delete();

        $proyecto = new Proyecto([
            'nombre' => 'GIMP',
            'descripcion' => 'Proyecto de la comunidad GNU para el desarrollo de la aplicación GIMP',
            'repositorio' => 'https://www.github.com/gimp',
            'fecha_inicio' => '19/09/2015',
            'fecha_fin_estimada' => '20/12/2017'
        ]);
        $proyecto->save();

        $proyecto = new Proyecto([
            'nombre' => 'Gmail',
            'descripcion' => 'Proyecto de código abierto relativo a la aplicación de correo de Google',
            'repositorio' => 'https://www.bitbucket.org/gmail',
            'fecha_inicio' => '20/12/2016',
            'fecha_fin_estimada' => '20/12/2017'
        ]);
        $proyecto->save();

        $proyecto = new Proyecto([
            'nombre' => 'Ionic JS',
            'descripcion' => 'Proyecto dedicado al desarrollo del framework Ionic JS para el desarrollo de aplicaciones multiplataforma',
            'repositorio' => 'https://www.github.com/ionicjs',
            'fecha_inicio' => '20/12/2015',
            'fecha_fin_estimada' => '20/12/2017'
        ]);
        $proyecto->save();

        $proyecto = new Proyecto([
            'nombre' => 'Bootstrap',
            'descripcion' => 'Proyecto de desarrollo por parte de Twitter para el framework Bootstrap. Diseño web.',
            'repositorio' => 'https://www.bootstrap.com',
            'fecha_inicio' => '12/05/2014',
            'fecha_fin_estimada' => '20/12/2017'
        ]);
        $proyecto->save();

        $proyecto = new Proyecto([
            'nombre' => 'Foundation',
            'descripcion' => 'Proyecto de desarrollo por parte de Zend para el framework Foundation. Diseño web.',
            'repositorio' => 'https://www.foundation.com',
            'fecha_inicio' => '12/05/2014',
            'fecha_fin_estimada' => '20/12/2017'
        ]);
        $proyecto->save();

        $proyecto = new Proyecto([
            'nombre' => 'Photoshop',
            'descripcion' => 'Proyecto de desarrollo de Photoshop. Grupo de ingeniería',
            'repositorio' => 'https://www.github.com/photoshop',
            'fecha_inicio' => '01/06/2013',
            'fecha_fin_estimada' => '20/12/2017'
        ]);
        $proyecto->save();

        $proyecto = new Proyecto([
            'nombre' => 'JIRA',
            'descripcion' => 'Proyecto de desarrollo de plataforma de desarrollo',
            'repositorio' => 'https://www.bitbucket.org/jira',
            'fecha_inicio' => '01/06/2012',
            'fecha_fin_estimada' => '20/12/2017'
        ]);
        $proyecto->save();

        $proyecto = new Proyecto([
            'nombre' => 'Trello',
            'descripcion' => 'Pizarras interactivas de SCRUM',
            'repositorio' => 'https://www.trello.com',
            'fecha_inicio' => '01/06/2012',
            'fecha_fin_estimada' => '20/12/2017'
        ]);
        $proyecto->save();

        $proyecto = new Proyecto([
            'nombre' => 'iOS',
            'descripcion' => 'Proyecto de la compañía Apple Ltd para el desarrollo de su sistema operativo móvil',
            'repositorio' => 'https://www.apple.com',
            'fecha_inicio' => '12/05/2013',
            'fecha_fin_estimada' => '20/12/2017'
        ]);
        $proyecto->save();

        $proyecto = new Proyecto([
            'nombre' => 'Android',
            'descripcion' => 'Proyecto de la compañía Google Ltd para el desarrollo de su sistema operativo móvil',
            'repositorio' => 'https://www.google.com',
            'fecha_inicio' => '12/05/2013',
            'fecha_fin_estimada' => '20/12/2017'
        ]);
        $proyecto->save();

        $proyecto = new Proyecto([
            'nombre' => 'Windows Phone',
            'descripcion' => 'Proyecto de la compañía Microsoft Ltd para el desarrollo de su sistema operativo móvil',
            'repositorio' => 'https://www.microsoft.com',
            'fecha_inicio' => '12/05/2013',
            'fecha_fin_estimada' => '20/12/2017'
        ]);
        $proyecto->save();

    }
}
