<?php

namespace App\Http\Controllers;

use App\Models\Grupo;
use App\Models\Docente;
use App\Http\Requests\DocenteRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;

class DocenteController extends Controller
{
    //Mostrar docentes
    public function index()
    {
        $docentes = Docente::index();
        return view('docente.index', compact('docentes'));
    }

    //Guardar docente
    public function store(DocenteRequest $request)
    {
        if (Gate::denies('create_docente'))
            return back()->with('error', config('app.denies'));

        Docente::create($request->validated());
        return redirect()->route('docentes.index')->with('success', config('app.created'));
    }

    //Ver grupos de un docente
    public function show($docente_id)
    {
        $docente = DB::table('docentes')->find($docente_id, ['id', 'nombre']);
        $grupos = Grupo::docente($docente->id);
        return view('docente.show', compact('grupos','docente'));
    }

    //Formulario para editar un docente
    public function edit(Docente $docente)
    {
        return view('docente.edit', compact('docente'));
    }

    //Actualizar un docente
    public function update(DocenteRequest $request, Docente $docente)
    {
        $docente->update($request->validated());
        return redirect()->route('docentes.index')->with('success', config('app.updated'));
    }

    //Eliminar un docente
    public function destroy(Docente $docente)
    {
        if ($docente->grupos()->count() > 0)
            return redirect()->route('docentes.edit', $docente->id)->with('error', config('app.undeleted'));

        $docente->delete();
        return redirect()->route('docentes.index')->with('success', config('app.deleted'));
    }
}
