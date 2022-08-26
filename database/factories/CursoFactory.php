<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class CursoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'nombre' => $this->faker->unique()->words(3, true),
            'activo' => $this->faker->randomElement(['0', '1']),
            'imagen' => 'computacion_1.svg'
        ];
    }
}
