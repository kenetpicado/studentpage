<?php

namespace Database\Seeders;

use App\Models\Curso;
use App\Models\Docente;
use App\Models\Grupo;
use App\Models\Inscripcion;
use Illuminate\Database\Seeder;
use App\Models\Matricula;
use App\Models\Mensaje;
use App\Models\Modulo;
use App\Models\Nota;
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

        Curso::factory(10)->create();
        //Modulo::factory(40)->create();
        Docente::factory(10)->create();
        
        //Promotor::factory(15)->create();
        Grupo::factory(25)->create();

        Matricula::factory(10)->create();
        //Inscripcion::factory(200)->create();

        //Nota::factory(300)->create();
        //Mensaje::factory(50)->create();
    }
}
