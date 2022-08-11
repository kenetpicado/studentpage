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
        $docente = Docente::all()->random();
        return [
            'horario' => $this->faker->word(),
            'sucursal' => $docente->sucursal,
            'anyo' => $this->faker->numberBetween(2018, 2022),
            'activo' => $this->faker->numberBetween(0, 1),
            'curso_id' => Curso::all()->random()->id,
            'docente_id' => $docente->id,
        ];
    }
}
