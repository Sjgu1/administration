<?php

use Illuminate\Database\Seeder;
use App\Rol;

class RolsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        DB::table('rols')->delete();

        $rol = new Rol([
            'nombre' => 'Administrador',
            'descripcion' => 'Administrador del proyecto con permisos absolutos.'
        ]);
        $rol->save();

        $rol = new Rol([
            'nombre' => 'Scrum Master',
            'descripcion' => 'Perfil de Scrum Master. Encargado de administrar y coordinar el proyecto y a los desarrolladores'
        ]);
        $rol->save();

        $rol = new Rol([
            'nombre' => 'Product Owner',
            'descripcion' => 'Perfil de product owner. Encargado de revisar la ejecución del proyecto'
        ]);
        $rol->save();

        $rol = new Rol([
            'nombre' => 'Desarrollador',
            'descripcion' => 'Perfil de desarrollador. Encargado de la ejecución del proyecto'
        ]);
        $rol->save();

    }
}
