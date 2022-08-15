<?php

namespace App\Http\Controllers;

use App\Models\Nota;
use App\Models\Grupo;
use App\Models\Modulo;
use App\Models\Inscripcion;
use Illuminate\Http\Request;
use App\Http\Requests\NotaRequest;
use Illuminate\Support\Facades\DB;

class NotaController extends Controller
{
    //Ver notas
    public function index($inscripcion_id)
    {
        $inscripcion = DB::table('inscripciones')->find($inscripcion_id);
        $notas = Nota::index($inscripcion_id);
        return view('nota.index', compact('notas', 'inscripcion'));
    }

    //Crear nota
    public function create($inscripcion_id)
    {
        $inscripcion = Inscripcion::create_nota($inscripcion_id);
        $modulos = Modulo::where('curso_id', $inscripcion->curso_id)->get();
        return view('nota.create', compact('modulos', 'inscripcion'));
    }

    //Guardar nota
    public function store(NotaRequest $request)
    {
        Nota::create($request->all());
        return redirect()->route('notas.index', $request->inscripcion_id)->with('success', 'Nota guardada correctamente');
    }

    //Editar nota
    public function edit($nota_id)
    {
        $nota = Nota::edit($nota_id);
        $modulos = Modulo::where('curso_id', $nota->curso_id)->get();
        return view('nota.edit', compact('nota', 'modulos'));
    }

    //Actualizar nota
    public function update(NotaRequest $request, Nota $nota)
    {
        $nota->update($request->all());
        return redirect()->route('notas.index', $nota->inscripcion_id)->with('success', 'Nota actualizada correctamente');
    }

    //Eliminar una nota
    public function destroy(Nota $nota)
    {
        $nota->delete();
        return redirect()->route('notas.index', $nota->inscripcion)->with('success', 'Nota eliminada correctamente');
    }

    //Ver reporte de notas
    public function show($grupo_id)
    {
        $grupo = Grupo::reporte($grupo_id);
        $inscripciones = Inscripcion::getToReport($grupo_id);
        return view('nota.show', compact('inscripciones', 'grupo'));
    }

    //Ver certificado de notas
    public function showCertified(Inscripcion $inscripcion)
    {
        $notas = Nota::getByInscripcion($inscripcion->id);
        return view('nota.certified', compact('inscripcion', 'notas'));
    }
}
