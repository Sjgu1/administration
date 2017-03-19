<?php

use Illuminate\Database\Seeder;
use App\Rol;
use App\Permiso;

class PermisosRolsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('permiso_rol')->delete();

        $rol = new Rol(['descripcion' => 'Rol prueba asociación permiso 1']);
        $rol->save();

        $permiso = new Permiso(['descripcion' => 'Permiso prueba asociación rol 1']);
        $permiso->save();

        /*$requisito2 = new Requisito(['descripcion' => 'Requisito prueba dependencia 2']);
        $requisito2->save();*/

        $rol->permisos()->attach($permiso->id);

    }
}
