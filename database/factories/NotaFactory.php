<?php

namespace Database\Factories;

use App\Models\Inscripcion;
use App\Models\Modulo;
use Illuminate\Database\Eloquent\Factories\Factory;

class NotaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'valor' => $this->faker->numberBetween(0, 100),
            'created_at' => $this->faker->date('Y-m-d'),
            'modulo_id' => Modulo::all()->random()->id,
            'inscripcion_id' => Inscripcion::all()->random()->id,
        ];
    }
}
