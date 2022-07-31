<?php

namespace App\Http\Controllers;

use App\Models\Matricula;
use App\Mail\VerMatricula;
use App\Services\FormattingRequest;
use Illuminate\Support\Facades\Gate;
use App\Http\Requests\MatriculaRequest;

class MatriculaController extends Controller
{
    //Ver todas las matriculas
    public function index()
    {
        switch (true) {

            case (auth()->user()->rol == 'promotor'):
                $matriculas = Matricula::getMatriculasPromotor(auth()->user()->sub_id);
                break;

            case (auth()->user()->rol == 'admin' && auth()->user()->sucursal != 'all'):
                $matriculas = Matricula::getMatriculasSucursal();
                break;

            default:
                $matriculas = Matricula::getMatriculas();
                break;
        }

        return view('matricula.index', compact('matriculas'));
    }

    public function create()
    {
        return view('matricula.create');
    }

    //Guardar nueva matricula
    public function store(MatriculaRequest $request)
    {
        $formated = (new FormattingRequest)->alumno($request);

        $matricula = Matricula::create($formated->all());
        (new UserController)->store($formated, $matricula->id);
        return redirect()->route('matriculas.index')->with('success', 'Matricula guardada correctamente');
    }

    //Ver datos de una matricula
    public function show(Matricula $matricula)
    {
        return new VerMatricula($matricula);
    }

    //Editar una matricula
    public function edit(Matricula $matricula)
    {
        if (auth()->user()->rol == 'promotor')
            Gate::authorize('propietario-matricula', $matricula);

        return view('matricula.edit', compact('matricula'));
    }

    //Actualizar matricula
    public function update(MatriculaRequest $request, Matricula $matricula)
    {
        if (auth()->user()->rol == 'promotor')
            Gate::authorize('propietario-matricula', $matricula);

        $matricula->update($request->all());
        (new UserController)->update($matricula);
        return redirect()->route('matriculas.index')->with('success', 'Actualizado');
    }

    //Eliminar matricula
    public function destroy(Matricula $matricula)
    { 
        if ($matricula->inscripciones()->count() > 0)
            return redirect()->route('matriculas.edit', $matricula->id)->with('error', 'No es posible eliminar');

        (new UserController)->destroy($matricula->carnet);
        $matricula->delete();
        return redirect()->route('matriculas.index')->with('success', 'Eliminado');
    }

    public function cambiarEstado($matricula_id)
    {
        $matricula = Matricula::find($matricula_id, ['id', 'activo']);

        $matricula->update([
            'activo' => $matricula->activo == '1'  ? '0':'1'
        ]);
        
        return back()->with('success', 'Estado de la matricula actualizado');
    }
}
