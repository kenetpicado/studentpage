<?php

namespace App\Http\Controllers;

use App\Models\Nota;
use App\Models\Grupo;
use App\Models\Inscripcion;
use Illuminate\Http\Request;
use App\Http\Requests\NotaRequest;
use App\Models\Modulo;
use Illuminate\Support\Facades\DB;

class NotaController extends Controller
{
    //Ver notas
    public function index($inscripcion_id)
    {
        $inscripcion = DB::table('inscripciones')
            ->where('inscripciones.id', $inscripcion_id)
            ->select([
                'inscripciones.*',
                'grupos.curso_id'
            ])
            ->join('grupos', 'inscripciones.grupo_id', '=', 'grupos.id')
            ->first();

        $notas = DB::table('notas')
            ->where('notas.inscripcion_id', $inscripcion->id)
            ->select([
                'notas.*',
                'modulos.nombre as modulo_nombre'
            ])
            ->join('modulos', 'notas.modulo_id', '=', 'modulos.id')
            ->get();

        $modulos = Modulo::where('curso_id', $inscripcion->curso_id)->get();
        return view('nota.index', compact('inscripcion', 'modulos', 'notas'));
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
        //$nota = Nota::forEdit($nota_id);
        $nota = DB::table('notas')
            ->where('notas.id', $nota_id)
            ->select([
                'notas.*',
                'modulos.id as modulo_id',
                'modulos.curso_id as curso_id',
                'inscripciones.grupo_id as grupo_id'
            ])
            ->join('inscripciones', 'notas.inscripcion_id', '=', 'inscripciones.id')
            ->join('modulos', 'notas.modulo_id', '=', 'modulos.id')
            ->first();

        $modulos = Modulo::where('curso_id', $nota->curso_id)->get();
        return view('nota.edit', compact('nota', 'modulos'));
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
