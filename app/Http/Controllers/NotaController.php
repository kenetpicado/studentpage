<?php

namespace App\Http\Controllers;

use App\Models\Nota;
use App\Models\Grupo;
use App\Models\Modulo;
use App\Models\Inscripcion;
use Illuminate\Http\Request;
use App\Http\Requests\NotaRequest;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\DB;

use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class NotaController extends Controller
{
    //Ver notas
    public function index($inscripcion_id)
    {
        $inscripcion = DB::table('inscripciones')->find($inscripcion_id);
        $matricula = DB::table('matriculas')->find($inscripcion->matricula_id, ['id', 'nombre']);
        $notas = Nota::index($inscripcion_id);
        return view('nota.index', compact('notas', 'inscripcion', 'matricula'));
    }

    //Crear nota
    public function create($grupo_id)
    {
        if (Gate::denies('create_nota'))
            return back()->with('error', config('app.denies'));

        $inscripciones = Inscripcion::getByGrupo($grupo_id);
        $grupo = DB::table('grupos')
            ->where('grupos.id', $grupo_id)
            ->join('cursos', 'grupos.curso_id', '=', 'cursos.id')
            ->first([
                'grupos.id',
                'grupos.horario',
                'cursos.nombre',
                'cursos.id as curso_id'
            ]);
        $modulos = DB::table('modulos')->where('curso_id', $grupo->curso_id)->get();

        return view('nota.create', compact('inscripciones', 'grupo', 'modulos'));
    }

    //Guardar nota
    public function store(NotaRequest $request)
    {
        foreach ($request->inscripcion_id as $key => $inscripcion) {
            Nota::create([
                'valor' => $request->valor[$key],
                'created_at' => $request->created_at,
                'modulo_id' => $request->modulo_id,
                'inscripcion_id' => $inscripcion,
            ]);
        }
        return redirect()->route('grupos.show', $request->grupo_id)->with('success', config('app.created'));
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
        return redirect()->route('notas.index', $nota->inscripcion_id)->with('success', config('app.updated'));
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
