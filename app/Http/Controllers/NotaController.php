<?php

namespace App\Http\Controllers;

use App\Models\Nota;
use App\Models\Grupo;
use App\Models\Matricula;
use App\Models\Inscripcion;
use Illuminate\Http\Request;
use App\Http\Requests\NotaRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;

class NotaController extends Controller
{
    //Ver notas
    public function index($inscripcion_id)
    {
        $deny = auth()->user()->permisos->contains('denegar', 'edit_nota');
        $inscripcion = DB::table('inscripciones')->find($inscripcion_id);
        $matricula = Matricula::nombre($inscripcion->matricula_id);
        $notas = Nota::index($inscripcion_id);
        return view('nota.index', compact('notas', 'inscripcion', 'matricula', 'deny'));
    }

    //Crear nota
    public function create($grupo_id)
    {
        if (Gate::denies('create_nota'))
            return back()->with('error', config('app.denies'));

        $inscripciones = Inscripcion::getByGrupo($grupo_id);
        if ($inscripciones->count() == 0)
            return redirect()->back()->with('error', config('app.empty'));

        $grupo = Grupo::showThis($grupo_id);
        $modulos = DB::table('modulos')->where('curso_id', $grupo->curso_id)->get();
        return view('nota.create', compact('inscripciones', 'grupo', 'modulos'));
    }

    //Guardar nota
    public function store(NotaRequest $request)
    {
        foreach ($request->inscripcion_id as $key => $inscripcion) {

            if ($request->enviar[$key] == 0)
                continue;

            Nota::updateOrCreate(
                ['modulo_id' => $request->modulo_id, 'inscripcion_id' => $inscripcion],
                ['valor' => $request->valor[$key], 'created_at' => $request->created_at]
            );
        }
        return redirect()->route('grupos.show', $request->grupo_id)->with('success', config('app.created'));
    }

    //Actualizar nota
    public function update(NotaRequest $request)
    {
        $notas = Nota::orderBy('modulo_id')->find($request->nota_id, ['id', 'valor']);
        if (!$notas)
            return redirect()->route('grupos.show', $request->grupo_id)->with('error', config('app.noupdated'));
            
        $notas->each(function ($nota, $key) use ($request) {
            if ($nota->valor != $request->valor[$key])
                $nota->update(['valor' => $request->valor[$key]]);
        });
        return redirect()->route('grupos.show', $request->grupo_id)->with('success', config('app.updated'));
    }

    //Eliminar una nota
    public function destroy(Nota $nota)
    {
        $nota->delete();
        return redirect()->route('notas.index', $nota->inscripcion)->with('success', config('app.deleted'));
    }

    //Ver reporte de notas
    public function show($grupo_id)
    {
        $grupo = Grupo::reporte($grupo_id);
        $inscripciones = Inscripcion::getToReport($grupo_id);
        return view('nota.show', compact('inscripciones', 'grupo'));
    }

    //Ver certificado de notas
    public function certificado(Inscripcion $inscripcion)
    {
        $notas = Nota::index($inscripcion->id);
        return view('nota.certified', compact('inscripcion', 'notas'));
    }
}
