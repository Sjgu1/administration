<?php

use Illuminate\Database\Seeder;
use App\Sprint;
use App\Proyecto;

class SprintsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         //Team::all()->delete();
        DB::table('sprints')->delete();

        $sprint = new Sprint(['descripcion' => 'Hola']);
        $proyecto = Proyecto::where('nombre', 'Proyecto número 1')->first();
        $sprint->proyecto()->associate($proyecto);
        $sprint->save();

        $sprint = new Sprint(['descripcion' => 'Hola']);
        $proyecto = Proyecto::where('nombre', 'Proyecto número 1')->first();
        $sprint->proyecto()->associate($proyecto);
        $sprint->save();
    }
}
