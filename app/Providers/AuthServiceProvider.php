<?php

namespace App\Providers;

use App\Models\Grupo;
use App\Models\Inscripcion;
use App\Models\Mensaje;
use App\Models\User;
use App\Policies\MensajePolicy;
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

        Gate::define('alumno-nota', function (User $user, $inscripcion_id) {
            return $user->sub_id === Inscripcion::find($inscripcion_id)->matricula_id;
        });

        Gate::define('alumno-mensaje', function (User $user, $grupo_id) {
            return Inscripcion::where('grupo_id', $grupo_id)->where('matricula_id', $user->sub_id)->count() > 0;
        });

        Gate::define('docente_autorizado', function (User $user, $grupo_id = null) {
            if ($user->rol == 'docente')
                return $user->sub_id == (Grupo::find($grupo_id, ['docente_id'])->docente_id ?? '0');

            return true;
        });

        Gate::define('propietario-matricula', function (User $user, $matricula) {
            if ($user->rol == 'promotor')
                return $user->sub_id == $matricula->promotor_id;

            return true;
        });
    }
}
