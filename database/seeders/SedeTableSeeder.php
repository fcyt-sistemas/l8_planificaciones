<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class SedeTableSeeder extends Seeder
{
    public function __construct()
	{
		$this->table = 'sedes';
		$this->filename = base_path().'/database/seeds/csvs/datos/sedes.csv';
	}

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $sede=new Sede();
    }
}
