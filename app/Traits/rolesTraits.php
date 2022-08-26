<?php

namespace App\Traits;

trait rolesTraits
{
    public static function enSucursal()
    {
        return auth()->user()->sucursal != 'all';
    }

    public static function adminSucursal()
    {
        return auth()->user()->sucursal != 'all' && auth()->user()->rol == 'admin';
    }

    public static function adminGlobal()
    {
        return auth()->user()->sucursal == 'all' && auth()->user()->rol == 'admin';
    }

    public static function esPromotor()
    {
        return auth()->user()->rol == 'promotor';
    }

    public static function esDocente()
    {
        return auth()->user()->rol == 'docente';
    }
}
