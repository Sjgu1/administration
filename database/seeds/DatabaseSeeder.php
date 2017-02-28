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
        // Proyectos seed
        $this->call(ProyectosTableSeeder::class);

        // Sprints seed
        $this->call(SprintsTableSeeder::class);

        // Requisitos seed
        $this->call(RequisitosTableSeeder::class);
    }
}
