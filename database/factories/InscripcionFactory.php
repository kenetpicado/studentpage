<?php

namespace Database\Factories;

use App\Models\Grupo;
use App\Models\Matricula;
use Illuminate\Database\Eloquent\Factories\Factory;

class InscripcionFactory extends Factory
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
            'grupo_id' => Grupo::all()->random()->id,
            'matricula_id' => Matricula::all()->random()->id,
        ];
    }
}
