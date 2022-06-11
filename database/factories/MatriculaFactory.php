<?php

namespace Database\Factories;

use App\Models\Promotor;
use Illuminate\Database\Eloquent\Factories\Factory;

class MatriculaFactory extends Factory
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
            'nombre' => $this->faker->name(),
            'cedula' => $this->faker->unique()->bothify('281-######-####?'),
            'fecha_nac' => $this->faker->date('Y-m-d'),
            'tel' => $this->faker->numerify('########'),
            'tutor' => $this->faker->name(),
            'grado' => $this->faker->word(),
            'carnet' => $this->faker->unique()->bothify('0004-######-###'),
            'pin' => $this->faker->bothify('#?#?#?'),
            'sucursal' => $this->faker->randomElement(['CH', 'MG']),
            'promotor_id' => $this->faker->boolean() ? '1' : Promotor::all()->random()->id,
            'created_at' => $this->faker->date('Y-m-d'),
        ];
    }
}
