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
        $permiso9 = Permiso::where('id', '9')->first();
        $permiso10 = Permiso::where('id', '10')->first();
        $permiso11 = Permiso::where('id', '11')->first();
        $permiso12 = Permiso::where('id', '12')->first();

        $rol->permisos()->attach($permiso1->id);
        $rol->permisos()->attach($permiso2->id);
        $rol->permisos()->attach($permiso3->id);
        $rol->permisos()->attach($permiso4->id);
        $rol->permisos()->attach($permiso5->id);
        $rol->permisos()->attach($permiso6->id);
        $rol->permisos()->attach($permiso7->id);
        $rol->permisos()->attach($permiso8->id);
        $rol->permisos()->attach($permiso9->id);
        $rol->permisos()->attach($permiso10->id);
        $rol->permisos()->attach($permiso11->id);
        $rol->permisos()->attach($permiso12->id);

        $rol = Rol::where('id', '3')->first();
        $rol->permisos()->attach($permiso2->id);
        $rol->permisos()->attach($permiso6->id);

        $rol = Rol::where('id', '2')->first();
        $rol->permisos()->attach($permiso2->id);
        $rol->permisos()->attach($permiso4->id);
        $rol->permisos()->attach($permiso5->id);
        $rol->permisos()->attach($permiso6->id);
        $rol->permisos()->attach($permiso7->id);

        $rol = Rol::where('id', '4')->first();
        $rol->permisos()->attach($permiso2->id);
        $rol->permisos()->attach($permiso4->id);
        $rol->permisos()->attach($permiso5->id);
        $rol->permisos()->attach($permiso6->id);
        $rol->permisos()->attach($permiso7->id);
    }
}
