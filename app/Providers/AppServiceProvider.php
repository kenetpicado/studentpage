<?php

namespace App\Providers;

use App\Models\Promotor;
use App\Models\Docente;
use App\Models\Matricula;
use App\Models\Pago;
use App\Observers\DocenteObserver;
use App\Observers\MatriculaObserver;
use App\Observers\PagoObserver;
use App\Observers\PromotorObserver;
use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Docente::observe(DocenteObserver::class);
        Promotor::observe(PromotorObserver::class);
        Matricula::observe(MatriculaObserver::class);
        Pago::observe(PagoObserver::class);
        Paginator::useBootstrap();
    }
}
