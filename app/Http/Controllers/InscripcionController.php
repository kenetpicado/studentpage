<?php

namespace App\Http\Controllers;

use App\Models\Matricula;
use App\Models\Grupo;
use App\Http\Requests\InscribirRequest;
use App\Models\Inscripcion;
use Illuminate\Routing\Route;
use Illuminate\Support\Facades\Gate;

class InscripcionController extends Controller
{
    //Cargar grupos disponibles para la matricula
    public function create($matricula_id, $type)
    {
        Gate::authorize('admin');
        $matricula = Matricula::find($matricula_id, ['id', 'nombre', 'sucursal']);
        $grupos = Grupo::getGruposCurrents($matricula->sucursal);
        return view('inscripcion.create', compact('matricula', 'grupos', 'type'));
    }

    //Guardar inscripcion
    public function store(InscribirRequest $request)
    {
        Gate::authorize('admin');
        Inscripcion::create($request->all());
        Matricula::putActive($request->matricula_id);

        if ($request->from == 'global')
            return redirect()->route('matriculas.index')->with('info', config('app.add'));
        else
            return redirect()->route('promotores.show', $request->from)->with('info', config('app.add'));
    }

    //Cambiar de grupo
    public function edit($matricula_id, $grupo_id)
    {
        Gate::authorize('admin');
        $inscripcion = Inscripcion::loadThisWith($grupo_id, $matricula_id, 'grupo:id,sucursal');
        $grupos = Grupo::getGruposCurrents($inscripcion->grupo->sucursal);
        return view('inscripcion.edit', compact('inscripcion', 'grupos'));
    }

    //Actualizar grupo
    public function update(InscribirRequest $request, $inscripcion_id)
    {
        Gate::authorize('admin');
        Inscripcion::find($inscripcion_id)->update($request->all());
        return redirect()->route('grupos.show', $request->oldview)->with('info', 'ok');
    }
}
