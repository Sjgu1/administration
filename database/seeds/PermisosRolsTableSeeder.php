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

       /* $rol = new Rol(['descripcion' => 'Rol prueba asociación permiso 1']);
        $rol->save();

        $permiso = new Permiso(['descripcion' => 'Permiso prueba asociación rol 1']);
        $permiso->save();

        /*$requisito2 = new Requisito(['descripcion' => 'Requisito prueba dependencia 2']);
        $requisito2->save();*/

        $rol = Rol::where('id', '1')->first();
        $permiso1 = Permiso::where('id', '1')->first();
        $permiso2 = Permiso::where('id', '2')->first();
        $permiso3 = Permiso::where('id', '3')->first();
        $permiso4 = Permiso::where('id', '4')->first();
        $permiso5 = Permiso::where('id', '5')->first();
        $permiso6 = Permiso::where('id', '6')->first();
        $permiso7 = Permiso::where('id', '7')->first();
        $permiso8 = Permiso::where('id', '8')->first();

        $rol->permisos()->attach($permiso1->id);
        $rol->permisos()->attach($permiso2->id);
        $rol->permisos()->attach($permiso3->id);
        $rol->permisos()->attach($permiso4->id);
        $rol->permisos()->attach($permiso5->id);
        $rol->permisos()->attach($permiso6->id);
        $rol->permisos()->attach($permiso7->id);
        $rol->permisos()->attach($permiso8->id);

        $rol = Rol::where('id', '3')->first();
        $rol->permisos()->attach($permiso2->id);
        $rol->permisos()->attach($permiso6->id);

        $rol = Rol::where('id', '2')->first();
        $rol->permisos()->attach($permiso2->id);
        $rol->permisos()->attach($permiso4->id);
        $rol->permisos()->attach($permiso5->id);
        $rol->permisos()->attach($permiso6->id);
        $rol->permisos()->attach($permiso7->id);
    }
}
