<?php

namespace App\Http\Controllers;

use App\Models\Nota;
use App\Models\Grupo;
use App\Models\Inscripcion;
use Illuminate\Http\Request;
use App\Http\Requests\NotaRequest;

class NotaController extends Controller
{
    //Ver notas
    public function index(Inscripcion $inscripcion)
    {
        $inscripcion->load('notas');
        return view('nota.index', compact('inscripcion'));
    }

    //Guardar nota
    public function store(NotaRequest $request)
    {
        Nota::create($request->all());
        return back()->with('success', 'Guardado');
    }

    //Editar nota
    public function edit($nota_id)
    {
        $nota = Nota::forEdit($nota_id);
        return view('nota.edit', compact('nota'));
    }

    //Actualizar nota
    public function update(NotaRequest $request, Nota $nota)
    {
        $nota->update($request->all());
        return redirect()->route('notas.index', $nota->inscripcion_id)->with('success', 'Actualizado');
    }

    //Eliminar una nota
    public function destroy(Request $request, Nota $nota)
    {
        $nota->delete();
        return redirect()->route('notas.index', $request->inscripcion)->with('success', 'Eliminado');
    }

    //Ver reporte de notas
    public function show($grupo_id)
    {
        $grupo = Grupo::getToReport($grupo_id);
        $inscripciones = Inscripcion::getToReport($grupo_id);
        return view('nota.show', compact('inscripciones', 'grupo'));
    }

    //Ver certificado de notas
    public function showCertified(Inscripcion $inscripcion)
    {
        $inscripcion->load('notas');
        return view('nota.certified', compact('inscripcion'));
    }
}
