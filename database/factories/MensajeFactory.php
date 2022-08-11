<?php

namespace Database\Factories;

use App\Models\Grupo;
use Illuminate\Database\Eloquent\Factories\Factory;

class MensajeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'from' => $this->faker->name(),
            'contenido' => $this->faker->text(),
            'enlace' => $this->faker->url(),
            'created_at' => $this->faker->date('Y-m-d'),
            'grupo_id' => Grupo::all()->random()->id,
        ];
    }
}
