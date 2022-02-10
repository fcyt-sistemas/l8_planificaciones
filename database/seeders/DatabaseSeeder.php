<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        $this->call(SedeTableSeeder::class);
        $this->call(CarreraTableSeeder::class);
        $this->call(CarreraSedeTableSeeder::class);
        $this->call(DocenteTableSeeder::class);
        
        // La creación de datos de roles debe ejecutarse primero
        $this->call(RoleTableSeeder::class);
        $this->call(PlanTableSeeder::class);
        $this->call(CatedraTableSeeder::class);
        $this->call(PlanCatedraTableSeeder::class);

        // Los usuarios necesitarán los roles, carreras previamente generados
        $this->call(UserTableSeeder::class);
        $this->call(UnidadAcademicaTableSeeder::class);
    }
}
