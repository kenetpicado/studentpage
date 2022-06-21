<?php

namespace App\Http\Controllers;

use App\Models\Matricula;
use App\Models\Grupo;
use App\Http\Requests\InscribirRequest;
use App\Models\Inscripcion;
use Illuminate\Http\Request;

class InscripcionController extends Controller
{
    //Cargar grupos disponibles para la matricula
    public function create($matricula_id, $type)
    {
        $matricula = Matricula::find($matricula_id, ['id', 'nombre', 'sucursal']);
        $grupos = Grupo::getForInsc($matricula->sucursal);
        return view('inscripcion.create', compact('matricula', 'grupos', 'type'));
    }

    //Guardar inscripcion
    public function store(InscribirRequest $request)
    {
        Inscripcion::create($request->all());

        if ($request->from == 'global')
            return redirect()->route('matriculas.index')->with('info', 'Inscrito correctamente!');

        return redirect()->route('promotores.show', $request->from)->with('info', 'Inscrito correctamente!');
    }

    //Cambiar de grupo
    public function edit($inscripcion_id)
    {
        $inscripcion = Inscripcion::loadWithGrupo($inscripcion_id);
        $grupos = Grupo::getEditInsc($inscripcion->grupo->sucursal, $inscripcion->grupo->curso_id);
        return view('inscripcion.edit', compact('inscripcion', 'grupos'));
    }

    //Actualizar grupo
    public function update(InscribirRequest $request, $inscripcion_id)
    {
        Inscripcion::find($inscripcion_id)->update($request->all());
        return redirect()->route('grupos.show', $request->oldview)->with('info', config('app.update'));
    }

    public function destroy(Request $request, Inscripcion $inscripcion)
    {
        $inscripcion->delete();
        return redirect()->route('grupos.show', $request->grupo)->with('deleted', config('app.deleted'));
    }
}
