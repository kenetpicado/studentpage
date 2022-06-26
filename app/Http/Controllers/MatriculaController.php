<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreMatriculaRequest;
use App\Http\Requests\UpdateMatriculaRequest;
use App\Mail\VerMatricula;
use App\Models\Matricula;
use App\Models\User;
use Illuminate\Support\Facades\Gate;

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

    //Guardar nueva matricula
    public function store(StoreMatriculaRequest $request)
    {
        //Si es admin de sucursal especifica
        if (auth()->user()->sucursal != 'all')
            $request->merge(['sucursal' =>  auth()->user()->sucursal]);

        if ($request->carnet == '') {

            $request->merge([
                'carnet' =>  Generate::idEstudiante($request->sucursal, $request->fecha_nac)
            ]);

            //Verificar Carnet Unico
            $request->validate(['carnet' => 'unique:matriculas']);
        }

        $pin = Generate::pin();

        //Agregar campos que faltan
        $request->merge([
            'pin' => $pin,
            'promotor_id' => auth()->user()->sub_id,
            'created_at' => now()->format('Y-m-d'),
        ]);

        //Guardar datos
        $matricula = Matricula::create($request->all());

        //Crear cuenta de usuario
        User::create([
            'name' => $request->nombre,
            'email' => $request->carnet,
            'password' => bcrypt($pin),
            'rol' => 'alumno',
            'sucursal' => $request->sucursal,
            'sub_id' => $matricula->id,
        ]);

        return back()->with('success', 'Guardado');
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
    public function update(UpdateMatriculaRequest $request, Matricula $matricula)
    {
        $matricula->update($request->all());
        User::updateUser($matricula);
        return redirect()->route('matriculas.index')->with('success', 'Actualizado');
    }

    //Eliminar matricula
    public function destroy(Matricula $matricula)
    {
        if ($matricula->inscripciones()->count() > 0)
            return redirect()->route('matriculas.edit', $matricula->id)->with('error', 'No es posible eliminar');

        User::where('email', $matricula->carnet)->first()->delete();
        $matricula->delete();
        return redirect()->route('matriculas.index')->with('success', 'Eliminado');
    }
}
