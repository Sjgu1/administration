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

        $team = new Proyecto(['nombre' => 'Proyecto número 1']);
        $team->save();

        $team = new Proyecto(['nombre' => 'Proyecto número 2']);
        $team->save();

        $team = new Proyecto(['nombre' => 'Proyecto número 3']);
        $team->save();

        $team = new Proyecto(['nombre' => 'Proyecto número 4']);
        $team->save();

    }
}
