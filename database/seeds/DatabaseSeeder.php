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

        // Usuarios seed
        $this->call(UsuariosTableSeeder::class);

        // Rols seed
        $this->call(RolsTableSeeder::class);

        // Permisos seed
        $this->call(PermisosTableSeeder::class);



        // Proyectos usuarios seed
        $this->call(ProyectosUsuariosTableSeeder::class);

        // Requisitos dependencias con otros requisitos seed
        $this->call(RequisitosRequisitosTableSeeder::class);

        // Requisitos usuarios seed
        $this->call(RequisitosUsuariosTableSeeder::class);

        // Permisos rols seed
        $this->call(PermisosRolsTableSeeder::class);

        // PROVISIONAL
        // Rols usuarios seed
        $this->call(RolsUsuariosTableSeeder::class);

    }
}
