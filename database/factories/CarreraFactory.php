<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Carrera;

class CarreraFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    protected $model=Carrera::class;
    public function definition()
    {
        return [
        'codigo' => $faker->numberBetween(10000, 50000),
        'nombre' => $faker->sentence(3),
        'plan_vigente'=>$faker->numberBetween(1, 4),
        'tipo_carrera'=> 'Carrera de Grado',
        'resolucion'=>$faker->numberBetween(10000, 50000).'/'.$faker->numberBetween(10, 99).'ME',
        'termino_anios'=>$faker->numberBetween(4, 6),
        ];
    }
}
