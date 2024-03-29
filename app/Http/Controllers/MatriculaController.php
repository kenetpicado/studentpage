<?php

namespace App\Http\Controllers;

use App\Models\Matricula;
use Illuminate\Support\Facades\Gate;
use App\Http\Requests\MatriculaRequest;
use App\Services\Sucursal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;

class MatriculaController extends Controller
{
    //Ver todas las matriculas
    public function index()
    {
        $matriculas = Matricula::index();
        return view('matricula.index', compact('matriculas'));
    }

    //Crear nuevo matricula
    public function create()
    {
        if (Gate::denies('create_matricula'))
            return back()->with('error', config('app.denies'));

        $sucursales = (new Sucursal)->get();
        return view('matricula.create', compact('sucursales'));
    }

    //Guardar nueva matricula
    public function store(MatriculaRequest $request)
    {
        Matricula::create($request->validated());
        return redirect()->route('matriculas.index')->with('success', config('app.created'));
    }

    //Ver datos de una matricula
    public function show(Matricula $matricula)
    {
        return view('matricula.show', compact('matricula'));
    }

    //Editar una matricula
    public function edit(Matricula $matricula)
    {
        Gate::authorize('propietario-matricula', $matricula);
        return view('matricula.edit', compact('matricula'));
    }

    //Actualizar matricula
    public function update(MatriculaRequest $request, Matricula $matricula)
    {
        Gate::authorize('propietario-matricula', $matricula);
        $matricula->update($request->all());
        return redirect()->route('matriculas.index')->with('success', config('app.updated'));
    }

    //Eliminar matricula
    public function destroy(Matricula $matricula)
    {
        if ($matricula->inscripciones()->count() > 0)
            return redirect()->route('matriculas.edit', $matricula->id)->with('error', config('app.undeleted'));

        $matricula->delete();
        return redirect()->route('matriculas.index')->with('success', config('app.deleted'));
    }

    public function cambiarEstado(Request $request, $matricula_id)
    {
        $matricula = Matricula::find($matricula_id, ['id', 'activo']);
        $matricula->update([
            'activo' => $matricula->activo == '1'  ? '0' : '1'
        ]);

        if ($request->has('global'))
            return redirect()->route('matriculas.index')->with('success', config('app.updated'));

        return redirect()->route('promotores.show', $request->promotor_id)->with('success', config('app.updated'));
    }
}
