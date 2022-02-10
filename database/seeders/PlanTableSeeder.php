<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class PlanTableSeeder extends Seeder
{
    public function __construct()
	{
		$this->table = 'planes';
		$this->filename = base_path().'/database/seeds/csvs/datos/planes.csv';
	}
    
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
    }
}
