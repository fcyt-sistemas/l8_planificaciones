<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Planificacion;

class PlanificacionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    protected $model=Planificacion::Class;

    public function definition()
    {
        return [
        'sede_id' => $faker->numberBetween(1, 3),
        'catedra_id' => $faker->numberBetween(1, 30),
        'plan_id' => $faker->numberBetween(1, 4),
        'carrera_id' => $faker->numberBetween(1, 20),
        'docente_id' => $faker->numberBetween(1, 800),
        'anio_academico' => $faker->numberBetween(2017, 2020),
        'equipo_docente' => $faker->name.', '.$faker->name.', '.$faker->name,
        'anio_carrera' => $faker->numberBetween(1, 5),
        'regimen_materia' => $faker->sentence(1),
        'carga_horaria' => $faker->numberBetween(4, 8),
        'fundamentacion' => $faker->text(200),
        'objetivos' => $faker->text(200),
        'programa_contenidos' =>  $faker->text(200),
        'metodologia_trabajo' => $faker->text(100),
        'sistema_evaluacion' => $faker->sentence(200),
        'programa_practicos' => $faker->sentence(200),
        'bibliografia' => $faker->sentence(100),
        'requisitos_rendir' => $faker->text(100),
        'cronograma_trabajo' => $faker->sentence(200),
        'funciones_equipo' => $faker->sentence(200),
        'cronograma_actividades' => $faker->sentence(100),
        'mecanismos_autoeval' => $faker->sentence(20),    
    ];
    }
}
