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
            'nombre' => 'crear_sprint',
            'descripcion' => 'Permiso que habilita la creación de sprints en un determinado proyecto'
        ]);
        $permiso->save();

        $permiso = new Permiso([
            'nombre' => 'visualizar_sprint',
            'descripcion' => 'Permiso que habilita la visualización de sprints en un determinado proyecto'
        ]);
        $permiso->save();

        $permiso = new Permiso([
            'nombre' => 'modificar_sprint',
            'descripcion' => 'Permiso que habilita la modificación de sprints en un determinado proyecto'
        ]);
        $permiso->save();

        $permiso = new Permiso([
            'nombre' => 'borrar_sprint',
            'descripcion' => 'Permiso que habilita el borrado de sprints en un determinado proyecto'
        ]);
        $permiso->save();

        $permiso = new Permiso([
            'nombre' => 'crear_requisito',
            'descripcion' => 'Permiso que habilita la creación de requisitos en un determinado proyecto'
        ]);
        $permiso->save();

        $permiso = new Permiso([
            'nombre' => 'visualizar_requisito',
            'descripcion' => 'Permiso que habilita la visualización de requisitos en un determinado proyecto'
        ]);
        $permiso->save();

        $permiso = new Permiso([
            'nombre' => 'modificar_requisito',
            'descripcion' => 'Permiso que habilita la modificación de requisitos en un determinado proyecto'
        ]);
        $permiso->save();

        $permiso = new Permiso([
            'nombre' => 'borrar_requisito',
            'descripcion' => 'Permiso que habilita el borrado de requisitos en un determinado proyecto'
        ]);
        $permiso->save();

        $permiso = new Permiso([
            'nombre' => 'modificar_usuarios',
            'descripcion' => 'Permiso que habilita la modificación o borrado de usuarios en un determinado proyecto'
        ]);
        $permiso->save();

        $permiso = new Permiso([
            'nombre' => 'invitar_usuarios',
            'descripcion' => 'Permiso que habilita la invitación de usuarios en un determinado proyecto'
        ]);
        $permiso->save();

        $permiso = new Permiso([
            'nombre' => 'modificar_proyecto',
            'descripcion' => 'Permiso que habilita la modificación de los datos de un determinado proyecto'
        ]);
        $permiso->save();

        $permiso = new Permiso([
            'nombre' => 'borrar_proyecto',
            'descripcion' => 'Permiso que habilita el borrado de un determinado proyecto'
        ]);
        $permiso->save();
    }
}
