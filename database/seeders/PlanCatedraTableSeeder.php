<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class PlanCatedraTableSeeder extends Seeder
{
    public function __construct()
	{
		$this->table = 'plan_catedra';
		$this->filename = base_path().'/database/seeds/csvs/datos/plan_catedra.csv';
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
