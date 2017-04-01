<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Sprint;
use App\Requisito;

class RequisitosUsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $requisito = new Requisito(['descripcion' => 'Requisito prueba con usuario']);
        $sprint = Sprint::where('descripcion', 'Hola')->first();
        $requisito->sprint()->associate($sprint);
        $requisito->save();

        $user = new User(['nombre' => 'Usuario prueba con requisito']);
        $user->save();

        $user->requisitos()->attach($requisito->id);

    }
}
