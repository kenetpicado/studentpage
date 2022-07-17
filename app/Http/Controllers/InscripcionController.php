<?php

namespace App\Http\Controllers;

use App\Models\Grupo;
use App\Models\Matricula;
use App\Models\Inscripcion;
use Illuminate\Http\Request;
use App\Http\Requests\InscribirRequest;

class InscripcionController extends Controller
{
    //Cargar grupos disponibles para la matricula
    public function create($matricula_id, $type)
    {
        $matricula = Matricula::find($matricula_id, ['id', 'nombre', 'sucursal']);
        $grupos = Grupo::getForInscripciones($matricula->sucursal);
        return view('inscripcion.create', compact('matricula', 'grupos', 'type'));
    }

    //Guardar inscripcion
    public function store(InscribirRequest $request)
    {
        Inscripcion::create($request->all());

        if ($request->from == 'global')
            return redirect()->route('matriculas.index')->with('success', 'Inscrito');

        return redirect()->route('promotores.show', $request->from)->with('success', 'Inscrito');
    }

    //Cambiar de grupo
    public function edit($inscripcion_id)
    {
        $inscripcion = Inscripcion::withGrupoSucursal($inscripcion_id);
        $grupos = Grupo::getForInscripciones($inscripcion->grupo_sucursal);
        return view('inscripcion.edit', compact('inscripcion', 'grupos'));
    }

    //Actualizar grupo
    public function update(InscribirRequest $request, Inscripcion $inscripcion)
    {
        $inscripcion->update($request->all());
        return redirect()->route('grupos.show', $request->oldview)->with('success', 'Actualizado');
    }

    //Eliminar una inscripcion
    public function destroy(Request $request, Inscripcion $inscripcion)
    {
        $inscripcion->delete();
        return redirect()->route('grupos.show', $request->grupo)->with('success', 'Eliminado');
    }
}
