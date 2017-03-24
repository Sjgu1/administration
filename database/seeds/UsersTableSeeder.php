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

        $user = new User(['nombre' => 'Jesús Perales Hernández']);
        $user->save();

        $user = new User(['nombre' => 'Mario']);
        $user->save();

        $user = new User(['nombre' => 'Sergio']);
        $user->save();

        $user = new User(['nombre' => 'Laila']);
        $user->save();
    }
}
