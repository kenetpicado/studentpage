<?php

namespace App\Http\Controllers;

use App\Models\Grupo;
use App\Models\Inscripcion;
use App\Http\Requests\InscribirRequest;
use App\Models\Matricula;
use Illuminate\Support\Facades\DB;

class InscripcionController extends Controller
{
    //Cargar grupos disponibles para la matricula
    public function create($matricula_id, $type)
    {
        $matricula = DB::table('matriculas')->find($matricula_id, ['id', 'nombre', 'sucursal']);
        $grupos = Grupo::inscripcion($matricula->sucursal);
        return view('inscripcion.create', compact('matricula', 'grupos', 'type'));
    }

    //Guardar inscripcion
    public function store(InscribirRequest $request)
    {
        Inscripcion::create($request->validated());

        if ($request->from == 'global')
            return redirect()->route('matriculas.index')->with('success', config('app.created'));

        return redirect()->route('promotores.show', $request->from)->with('success', config('app.created'));
    }

    //Cambiar de grupo
    public function edit($inscripcion_id)
    {
        $inscripcion = Inscripcion::withGrupoSucursal($inscripcion_id);
        $grupos = Grupo::inscripcion($inscripcion->grupo_sucursal);
        $matricula = Matricula::nombre($inscripcion->matricula_id);
        return view('inscripcion.edit', compact('inscripcion', 'grupos', 'matricula'));
    }

    //Actualizar grupo
    public function update(InscribirRequest $request, Inscripcion $inscripcion)
    {
        $inscripcion->update($request->validated());
        return redirect()->route('grupos.show', $inscripcion->grupo_id)->with('success', config('app.updated'));
    }

    //Eliminar una inscripcion
    public function destroy(Inscripcion $inscripcion)
    {
        $inscripcion->delete();
        return redirect()->route('grupos.show', $inscripcion->grupo_id)->with('success', config('app.deleted'));
    }
}
