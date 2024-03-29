<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class PromotorFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'carnet' => $this->faker->unique()->bothify('PM-####'),
            'nombre' => $this->faker->name(),
            'correo' => $this->faker->unique()->email(),
        ];
    }
}
