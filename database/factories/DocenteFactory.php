<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class DocenteFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'carnet' => $this->faker->unique()->bothify('AA-####'),
            'nombre' => $this->faker->name(),
            'correo' => $this->faker->email(),
            'activo' => $this->faker->randomElement(['0', '1']),
            'sucursal' => $this->faker->randomElement(['CH', 'MG']),
        ];
    }
}
