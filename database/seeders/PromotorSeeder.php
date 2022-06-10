<?php

namespace Database\Seeders;

use App\Models\Promotor;
use Illuminate\Database\Seeder;

class PromotorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        Promotor::create([
            'carnet' => 'PM-0000',
            'nombre' => 'Promotor',
            'correo' => 'correo@gmail.com',
        ]);
    }
}
