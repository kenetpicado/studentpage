<?php

namespace App\Traits;

trait ScopesTraits
{
    public function scopeSucursal($q, $sucursal)
    {
        return $q->where('sucursal', $sucursal);
    }

    public function scopeActivo($q, $activo = '1')
    {
        return $q->where('activo', $activo);
    }

    public function scopeOrderNombre($q)
    {
        return $q->orderBy('nombre');
    }

    public function scopeLatestId($q)
    {
        return $q->latest('id');
    }

    public function scopeCountInscripciones($q)
    {
        return $q->withCount('inscripciones');
    }

    public function scopeWherePromotor($q, $promotor_id)
    {
        return $q->where('promotor_id', $promotor_id);
    }

    public function scopeWhereDocente($q, $docente_id)
    {
        return $q->where('docente_id', $docente_id);
    }

    public function scopeLoadGrupo($q, $grupo_id)
    {
        return $q->where('grupo_id', $grupo_id);
    }

    public function scopeLoadMatricula($q, $matricula_id)
    {
        return $q->where('matricula_id', $matricula_id);
    }
    
    public function scopeWithMatricula($q)
    {
        return $q->with('matricula:id,carnet,nombre');
    }
        
    public function scopewithCursoDocente($q)
    {
        return $q->with('curso:id,nombre')->with('docente:id,nombre');
    }
}
