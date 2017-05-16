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

        $requisito = Requisito::where('id', '1')->first();
        $user = User::where('id', '2')->first();
        $user->requisitos()->attach($requisito->id);

        $requisito = Requisito::where('id', '2')->first();
        $user = User::where('id', '1')->first();
        $user->requisitos()->attach($requisito->id);

        $requisito = Requisito::where('id', '3')->first();
        $user = User::where('id', '3')->first();
        $user->requisitos()->attach($requisito->id);

        $requisito = Requisito::where('id', '4')->first();
        $user = User::where('id', '3')->first();
        $user->requisitos()->attach($requisito->id);

        $requisito = Requisito::where('id', '5')->first();
        $user = User::where('id', '2')->first();
        $user->requisitos()->attach($requisito->id);

        $requisito = Requisito::where('id', '6')->first();
        $user = User::where('id', '1')->first();
        $user->requisitos()->attach($requisito->id);

        $requisito = Requisito::where('id', '7')->first();
        $user = User::where('id', '5')->first();
        $user->requisitos()->attach($requisito->id);

        $requisito = Requisito::where('id', '8')->first();
        $user = User::where('id', '6')->first();
        $user->requisitos()->attach($requisito->id);

        $requisito = Requisito::where('id', '9')->first();
        $user = User::where('id', '6')->first();
        $user->requisitos()->attach($requisito->id);

        $requisito = Requisito::where('id', '10')->first();
        $user = User::where('id', '6')->first();
        $user->requisitos()->attach($requisito->id);


        // Requisitos de prueba para burndown
        $requisito = Requisito::where('id', '13')->first();
        $user = User::where('id', '1')->first();
        $user->requisitos()->attach($requisito->id);

        $user = User::where('id', '2')->first();
        $user->requisitos()->attach($requisito->id);

    }
}
