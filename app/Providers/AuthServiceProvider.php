<?php

namespace App\Providers;

use App\Models\Inscripcion;
use App\Models\Matricula;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        //'App\Models\Nota' => 'App\Policies\ConsultaPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        //Solo promores y administradores
        Gate::define('admin-promotor', function ($user) {
            return $user->rol == 'promotor' || $user->rol == 'admin';
        });

        //Solo docentes y administradores
        Gate::define('admin-docente', function ($user) {
            return $user->rol == 'docente' || $user->rol == 'admin';
        });

        //Solo administradores
        Gate::define('admin', function ($user) {
            return $user->rol == 'admin';
        });

        //Solo alumno
        Gate::define('alumno', function ($user) {
            return $user->rol == 'alumno';
        });

        //SOLO NOTA DEL ALUMNO AL QUE LE PERTENECE
        Gate::define('alumno-nota', function ($user, $inscripcion_id) {
            $matricula = Matricula::where('carnet', $user->email)->first(['id']);
            $inscripcion = Inscripcion::find($inscripcion_id);
            return $user->rol == 'alumno' && $matricula->id === $inscripcion->matricula_id;
        });
    }
}
