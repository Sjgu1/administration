<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         $this->call(ProyectosSeeder::class);
         $this->call(SprintsSeeder::class);
         $this->call(RequisitosSeeder::class);
    }
}
