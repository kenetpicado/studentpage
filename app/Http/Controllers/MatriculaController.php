<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreMatriculaRequest;
use App\Http\Requests\UpdateMatriculaRequest;
use App\Mail\VerMatricula;
use App\Models\Matricula;
use App\Models\Promotor;
use Illuminate\Support\Facades\Gate;
use App\Models\User;

class MatriculaController extends Controller
{
    //Ver todas las matriculas
    public function index()
    {
        Gate::authorize('admin-promotor');

        switch (true) {

            case (auth()->user()->rol == 'promotor'):
                $promotor = User::getUserByCarnet(new Promotor());
                $matriculas = Matricula::getMatriculasPromotor($promotor->id);
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
        Gate::authorize('admin-promotor');

        //Obtener usuario
        $user = $request->user();

        //Si es admin de sucursal especifica
        if ($user->sucursal != 'all')
            $request->merge(['sucursal' =>  $user->sucursal,]);

        //Si matricula un admin id promotor es null
        $id = $user->rol == 'admin'
            ? null
            : Promotor::where('carnet', $user->email)->first(['id'])->id;

        $carnet = $request->carnet != ''
            ? $request->carnet
            : Generate::idEstudiante($request->sucursal, $request->fecha_nac);

        $pin = Generate::pin();

        //Agregar campos que faltan
        $request->merge([
            'carnet' =>  $carnet,
            'pin' => $pin,
            'promotor_id' => $id,
            'created_at' => now()->format('Y-m-d'),
        ]);

        //Verificar Carnet Unico
        $request->validate(['carnet' => 'unique:matriculas']);

        //Guardar datos
        Matricula::create($request->all());

        User::createUser($request->nombre, $carnet, $pin, 'alumno', $request->sucursal);
        return back()->with('info', config('app.add'));
    }

    //Ver datos de una matricula
    public function show(Matricula $matricula)
    {
        Gate::authorize('admin');
        return new VerMatricula($matricula);
    }

    //Editar una matricula
    public function edit($matricula_id)
    {
        Gate::authorize('admin-promotor');
        $matricula = Matricula::edit($matricula_id);
        return view('matricula.edit', compact('matricula'));
    }

    //Actualizar matricula
    public function update(UpdateMatriculaRequest $request, $matricula_id)
    {
        Gate::authorize('admin-promotor');
        User::updateUser(new Matricula(), $matricula_id, $request);
        return redirect()->route('matriculas.index')->with('info', config('app.update'));
    }

    //Eliminar matricula
    public function destroy(Matricula $matricula)
    {
        Gate::authorize('admin');

        if ($matricula->inscripciones()->count() > 0)
            return redirect()->route('matriculas.edit', $matricula->id)->with('message', config('app.undeleted'));

        User::where('email', $matricula->carnet)->first()->delete();
        $matricula->delete();
        return redirect()->route('matriculas.index')->with('deleted', config('app.deleted'));
    }
}
