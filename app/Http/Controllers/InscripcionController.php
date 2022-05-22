<?php

namespace App\Http\Controllers;

use App\Models\Matricula;
use App\Models\Grupo;
use App\Http\Requests\InscribirRequest;
use App\Models\Inscripcion;
use Illuminate\Support\Facades\Gate;

class InscripcionController extends Controller
{
    //Cargar grupos disponibles para la matricula
    public function create($matricula_id)
    {
        Gate::authorize('admin');

        $matricula = Matricula::find($matricula_id, ['id', 'sucursal']);
        $grupos = Grupo::getGruposCurrents($matricula->sucursal);

        return view('inscripcion.create', compact('matricula', 'grupos'));
    }

    //Guardar inscripcion
    public function store(InscribirRequest $request)
    {
        Gate::authorize('admin');

        Inscripcion::create($request->all());
        Matricula::putActive($request->matricula_id);

        return redirect()->route('matriculas.index')->with('info', 'ok');
    }

    public function edit($matricula_id, $grupo_id)
    {
        Gate::authorize('admin');

        $inscripcion = Inscripcion::loadWithGrupo($grupo_id, $matricula_id);
        $grupos = Grupo::getGruposCurrents($inscripcion->grupo->sucursal);

        return view('inscripcion.edit', compact('inscripcion', 'grupos'));
    }

    //Actualizar nuevo grupo
    public function update(InscribirRequest $request, $pivot_id)
    {
        Gate::authorize('admin');
        Inscripcion::find($pivot_id)->update($request->all());
        return redirect()->route('grupos.show', $request->oldview)->with('info', 'ok');
    }
}
