<?php

use Illuminate\Database\Seeder;
use App\Permiso;

class PermisosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        DB::table('permisos')->delete();

        $permiso = new Permiso([
            'nombre' => 'Crear sprint',
            'descripcion' => 'Permiso que habilita la creación de sprints en un determinado proyecto'
        ]);
        $permiso->save();

        $permiso = new Permiso([
            'nombre' => 'Visualizar sprint',
            'descripcion' => 'Permiso que habilita la visualización de sprints en un determinado proyecto'
        ]);
        $permiso->save();

        $permiso = new Permiso([
            'nombre' => 'Modificar sprint',
            'descripcion' => 'Permiso que habilita la modificación de sprints en un determinado proyecto'
        ]);
        $permiso->save();

        $permiso = new Permiso([
            'nombre' => 'Borrar sprint',
            'descripcion' => 'Permiso que habilita el borrado de sprints en un determinado proyecto'
        ]);
        $permiso->save();

        $permiso = new Permiso([
            'nombre' => 'Crear requisito',
            'descripcion' => 'Permiso que habilita la creación de requisitos en un determinado proyecto'
        ]);
        $permiso->save();

        $permiso = new Permiso([
            'nombre' => 'Visualizar requisito',
            'descripcion' => 'Permiso que habilita la visualización de requisitos en un determinado proyecto'
        ]);
        $permiso->save();

        $permiso = new Permiso([
            'nombre' => 'Modificar requisito',
            'descripcion' => 'Permiso que habilita la modificación de requisitos en un determinado proyecto'
        ]);
        $permiso->save();

        $permiso = new Permiso([
            'nombre' => 'Borrar requisito',
            'descripcion' => 'Permiso que habilita el borrado de requisitos en un determinado proyecto'
        ]);
        $permiso->save();

        $permiso = new Permiso(['nombre' => 'Permiso número 3']);
        $permiso->save();
    }
}
