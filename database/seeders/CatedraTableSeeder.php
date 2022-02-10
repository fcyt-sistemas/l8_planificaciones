<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class CatedraTableSeeder extends Seeder
{
    public function __construct()
	{
		$this->table = 'catedras';
		$this->filename = base_path().'/database/seeds/csvs/datos/catedras.csv';
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
