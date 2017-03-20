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

        $rol = new Rol(['nombre' => 'Rol número 1']);
        $rol->save();

        $rol = new Rol(['nombre' => 'Rol número 2']);
        $rol->save();

        $rol = new Rol(['nombre' => 'Rol número 3']);
        $rol->save();

    }
}
