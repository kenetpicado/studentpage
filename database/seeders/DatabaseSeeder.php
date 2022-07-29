<?php

namespace Database\Seeders;

use App\Models\Curso;
use App\Models\Docente;
use App\Models\Grupo;
use App\Models\Inscripcion;
use Illuminate\Database\Seeder;
use App\Models\Matricula;
use App\Models\Promotor;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UserSeeder::class);
        $this->call(PromotorSeeder::class);

        //Curso::factory(20)->create();
        //Docente::factory(30)->create();
        
        //Promotor::factory(15)->create();
        //Grupo::factory(15)->create();

        Matricula::factory(50)->create();
        //Inscripcion::factory(200)->create();
    }
}
