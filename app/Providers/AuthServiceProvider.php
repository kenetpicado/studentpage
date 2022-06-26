<?php

namespace App\Providers;

use App\Models\Grupo;
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

        Gate::define('propietario-nota', function ($user, $inscripcion) {
            return $user->sub_id == $inscripcion->matricula_id;
        });

        Gate::define('propietario-grupo', function ($user, $docente_id) {
            return $user->sub_id == $docente_id;
        });

        Gate::define('propietario-matricula', function ($user, $matricula) {
            return $user->sub_id === $matricula->promotor_id;
        });
    }
}
