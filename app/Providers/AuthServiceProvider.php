<?php

namespace App\Providers;

use App\Http\Middleware\Docente;
use App\Models\Grupo;
use App\Models\Inscripcion;
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

        Gate::define('alumno_autorizado', function ($user, $id) {
            return $user->sub_id === Inscripcion::find($id, ['matricula_id'])->matricula_id;
        });

        Gate::define('docente_autorizado', function ($user, $grupo_id) {
            if (auth()->user()->rol == 'docente')
                return $user->sub_id == Grupo::find($grupo_id, ['docente_id'])->docente_id;

            return true;
        });

        Gate::define('alumno_autorizado_mensajes', function ($user, $grupo_id) {
            return $user->sub_id === Inscripcion::where('grupo_id', $grupo_id)->where('matricula_id', auth()->user()->sub_id)->value('matricula_id');
        });

        Gate::define('propietario-matricula', function ($user, $matricula) {
            return $user->sub_id === $matricula->promotor_id;
        });
    }
}
