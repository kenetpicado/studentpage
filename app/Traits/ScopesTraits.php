<?php

namespace App\Traits;

trait ScopesTraits
{
    public function scopeSucursal($q, $sucursal)
    {
        return $q->where('sucursal', $sucursal);
    }

    public function scopeActivo($q)
    {
        return $q->where('activo', '1');
    }

    public function scopeOrderDocente($q)
    {
        return $q->orderBy('nombre');
    }

    public function scopeOrderCurso($q)
    {
        return $q->orderBy('nombre');
    }

    public function scopeCountInscripciones($q)
    {
        return $q->withCount('inscripciones');
    }

    public function scopeWherePromotor($q, $promotor_id)
    {
        return $q->where('promotor_id', $promotor_id);
    }

    public function scopeLoadGrupo($q, $grupo_id)
    {
        return $q->where('grupo_id', $grupo_id);
    }

    public function scopeLoadMatricula($q, $matricula_id)
    {
        return $q->where('matricula_id', $matricula_id);
    }
}
