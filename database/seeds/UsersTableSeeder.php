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
            'name' => 'Jesús',
            'apellidos' => 'Perales Hernández',
            'email' => 'jesusperalesh@gmail.com',
            'username' => 'jph11',
            'password' => bcrypt('123456'),
            'fecha_registro' => '20/05/2016'
        ]);
        $user->save();

        $user = new User([
            'name' => 'Mario',
            'apellidos' => 'Martínez Alfonso',
            'email' => 'mcnb@gmail.com',
            'username' => 'mma63',
            'password' => bcrypt('123456'),
            'fecha_registro' => '12/06/2016'
        ]);
        $user->save();

        $user = new User([
            'name' => 'Sergio Julio',
            'apellidos' => 'García Urdiales',
            'email' => 'sjgu@alu.ua.es',
            'username' => 'sjgu12',
            'password' => bcrypt('123456'),
            'fecha_registro' => '11/06/2017'
        ]);
        $user->save();

       $user = new User([
            'name' => 'Alfonso',
            'apellidos' => 'Martínez López',
            'email' => 'aml12@alu.ua.es',
            'username' => 'aml',
            'password' => bcrypt('123456'),
            'fecha_registro' => '04/03/2014'
        ]);
        $user->save();

        $user = new User([
            'name' => 'Lorena',
            'apellidos' => 'García Roca',
            'email' => 'lgr11@alu.ua.es',
            'username' => 'lgr',
            'password' => bcrypt('123456'),
            'fecha_registro' => '03/02/2012'
        ]);
        $user->save();

        $user = new User([
            'name' => 'Ana',
            'apellidos' => 'Más Murcia',
            'email' => 'amm139@alu.ua.es',
            'username' => 'amm139',
            'password' => bcrypt('123456'),
            'fecha_registro' => '03/02/2015'
        ]);
        $user->save();

        $user = new User([
            'name' => 'Asunción',
            'apellidos' => 'Martínez Pérez',
            'email' => 'amp@alu.ua.es',
            'username' => 'amp66',
            'password' => bcrypt('123456'),
            'fecha_registro' => '03/02/2015'
        ]);
        $user->save();

        $user = new User([
            'name' => 'Eustaquio Jesús',
            'apellidos' => 'García Rocamora',
            'email' => 'ppl44@yahoo.es',
            'username' => 'ppl66',
            'password' => bcrypt('123456'),
            'fecha_registro' => '03/02/2015'
        ]);
        $user->save();

        $user = new User([
            'name' => 'Manuel',
            'apellidos' => 'Campillo Duréndez',
            'email' => 'zocato@yahoo.es',
            'username' => 'ttr4',
            'password' => bcrypt('123456'),
            'fecha_registro' => '23/12/2000'
        ]);
        $user->save();

        $user = new User([
            'name' => 'Alejandro',
            'apellidos' => 'Rodríguez Portugués',
            'email' => 'arp@hotmail.com',
            'username' => 'arp23',
            'password' => bcrypt('123456'),
            'fecha_registro' => '14/12/199'
        ]);
        $user->save();

        $user = new User([
            'name' => 'Jimeno',
            'apellidos' => 'Escudero Albaladejo',
            'email' => 'jea@gcloud.ua.es',
            'username' => 'jea3',
            'password' => bcrypt('123456'),
            'fecha_registro' => '05/08/2017'
        ]);
        $user->save();
    }
}
