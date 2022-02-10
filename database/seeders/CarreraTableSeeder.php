<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class CarreraTableSeeder extends Seeder
{
    public function __construct()
	{
		$this->table = 'carreras';
		$this->filename = base_path().'/database/seeds/csvs/datos/carreras.csv';
	}
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        parent::run();
    }
}
