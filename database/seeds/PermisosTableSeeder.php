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

        $permiso = new Permiso(['nombre' => 'Permiso num 1']);
        $permiso->save();

        $permiso = new Permiso(['nombre' => 'Permiso num 2']);
        $permiso->save();
    }
}
