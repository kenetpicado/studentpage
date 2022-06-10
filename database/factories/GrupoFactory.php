<?php

namespace Database\Factories;

use App\Models\Curso;
use App\Models\Docente;
use Illuminate\Database\Eloquent\Factories\Factory;

use function GuzzleHttp\Promise\all;

class GrupoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            //
            'horario' => $this->faker->word(),
            'sucursal' => $this->faker->randomElement(['CH', 'MG']),
            'anyo' => '2022',
            'activo' => '1',
            'curso_id' => Curso::all()->random()->id,
            'docente_id' => Docente::all()->random()->id,
        ];
    }
}
