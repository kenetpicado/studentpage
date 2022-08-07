<?php

namespace App\Services;

class FormattingRequest
{
    public function docente(Object $request)
    {
        if (auth()->user()->sucursal != 'all')
            $request->merge(['sucursal' => auth()->user()->sucursal]);

        $request->merge([
            'carnet' =>  (new Credenciales)->id($request->sucursal, 4)
        ]);

        return $request;
    }

    public function promotor(Object $request)
    {
        $request->merge([
            'carnet' =>  (new Credenciales)->id('PM', 4),
        ]);

        return $request;
    }

    public function alumno(Object $request)
    {
        //Agregar sucursal
        if (auth()->user()->sucursal != 'all')
            $request->merge(['sucursal' =>  auth()->user()->sucursal]);

        if ($request->carnet == '') {

            $request->merge([
                'carnet' =>  (new Credenciales)->idEstudiante($request->sucursal, $request->fecha_nac)
            ]);

            //Verificar Carnet Unico
            $request->validate(['carnet' => 'unique:matriculas']);
        }

        //Agregar campos que faltan
        $request->merge([
            'pin' => (new Credenciales)->pin(),
            'promotor_id' => auth()->user()->sub_id,
            'created_at' => now()->format('Y-m-d'),
        ]);

        return $request;
    }
}
