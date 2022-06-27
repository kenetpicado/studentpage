<?php

namespace App\Services;


class Same
{
    public static function docente(Object $request, Object $docente)
    {
        return $request->only(['nombre', 'correo', 'activo']) == $docente->only(['nombre', 'correo', 'activo']);
    
        // if (Same::docente($request, $docente))
        //     return redirect()->route('docentes.index');
    }
}
