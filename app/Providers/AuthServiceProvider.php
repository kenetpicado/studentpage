<?php

namespace App\Providers;

use App\Models\GrupoMatricula;
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

        //Solo administradores
        Gate::define('alumno', function ($user) {
            return $user->rol == 'alumno';
        });

        //SOLO NOTA DEL ALUMNO AL QUE LE PERTENECE
        Gate::define('nota_mine', function ($user, $pivot_id) {
            $matricula = Matricula::where('carnet', $user->email)->first(['id']);
            $pivot = GrupoMatricula::find($pivot_id);
            return $matricula->id === $pivot->matricula_id;
        });
    }
}
