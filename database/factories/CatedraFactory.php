<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Catedra;

class CatedraFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */

    protected $model=Catedra::class;
    public function definition(Faker $faker)
    {
        return [
        'codigo' => $faker->numberBetween(10000, 50000),
        'nombre' => $faker->sentence(3),
        'periodo_lectivo'=>$faker->sentence(3),
        'carga_horaria'=> $faker->numberBetween(3, 10),
        ];
    }
}
