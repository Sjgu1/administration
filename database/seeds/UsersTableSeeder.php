<?php

use Illuminate\Database\Seeder;
use App\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Player::all()->delete();
        DB::table('users')->delete();

        $user = new User([
            'nombre' => 'Jesús',
            'apellidos' => 'Perales Hernández',
            'email' => 'jesusperalesh@gmail.com',
            'username' => 'jph11',
            'password' => '123456',
            'fecha_registro' => '20/05/2016'
        ]);
        $user->save();

        $user = new User([
            'nombre' => 'Mario',
            'apellidos' => 'Martínez Alfonso',
            'email' => 'mcnb@gmail.com',
            'username' => 'mma63',
            'password' => '123456',
            'fecha_registro' => '12/06/2016'
        ]);
        $user->save();

        $user = new User([
            'nombre' => 'Sergio Julio',
            'apellidos' => 'García Urdiales',
            'email' => 'sjgu@alu.ua.es',
            'username' => 'sjgu12',
            'password' => '123456',
            'fecha_registro' => '11/06/2017'
        ]);
        $user->save();

       $user = new User([
            'nombre' => 'Alfonso',
            'apellidos' => 'Martínez López',
            'email' => 'aml12@alu.ua.es',
            'username' => 'aml',
            'password' => '123456',
            'fecha_registro' => '04/03/2014'
        ]);
        $user->save();

        $user = new User([
            'nombre' => 'Lorena',
            'apellidos' => 'García Roca',
            'email' => 'lgr11@alu.ua.es',
            'username' => 'lgr',
            'password' => '123456',
            'fecha_registro' => '03/02/2012'
        ]);
        $user->save();

        $user = new User([
            'nombre' => 'Ana',
            'apellidos' => 'Más Murcia',
            'email' => 'amm139@alu.ua.es',
            'username' => 'amm139',
            'password' => '123456',
            'fecha_registro' => '03/02/2015'
        ]);
        $user->save();
    }
}
