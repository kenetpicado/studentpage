<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreMatriculaRequest;
use App\Http\Requests\UpdateMatriculaRequest;
use App\Mail\VerMatricula;
use App\Models\Matricula;
use App\Models\Promotor;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use App\Models\User;

class MatriculaController extends Controller
{
    
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    //Ver todas las matriculas
    public function index()
    {
        Gate::authorize('admin-promotor');
        $user = Auth::user();

        switch (true) {
            case ($user->rol == 'promotor'):
                $promotor = User::getUserByCarnet(new Promotor(), $user->email);
                $matriculas = Matricula::getMatriculasPromotor($promotor->id);
                break;

            case ($user->rol == 'admin' && $user->sucursal != 'all'):
                $matriculas = Matricula::getMatriculasSucursal($user->sucursal);
                break;

            default:
                $matriculas = Matricula::getMatriculas();
                break;
        }
        return view('matricula.index', compact('matriculas', 'user'));
    }

    //Guardar nueva matricula
    public function store(StoreMatriculaRequest $request)
    {
        Gate::authorize('admin-promotor');

        //Obtener usuario
        $user = $request->user();

        //Si es admin de sucursal especifica
        if ($user->sucursal != 'all') {
            $request->merge([
                'sucursal' =>  $user->sucursal,
            ]);
        }

        //Si matricula un admin id promotor es null
        $id = $user->rol == 'admin' ? null : Promotor::where('carnet', $user->email)->first(['id'])->id;

        $carnet = $request->carnet != '' ? $request->carnet : Generate::idEstudiante($request->sucursal . '04', $request->fecha_nac);
        $pin = Generate::pin();

        //Agregar campos que faltan
        $request->merge([
            'carnet' =>  $carnet,
            'pin' => $pin,
            'promotor_id' => $id,
        ]);

        //Guardar datos
        Matricula::create($request->all());
        User::createUser($request->nombre, $carnet, $pin, 'alumno', $request->sucursal);
        return back();
    }

    //Ver datos de una matricula
    public function show(Matricula $matricula)
    {
        Gate::authorize('admin-promotor');
        return new VerMatricula($matricula);
    }

    //Editar una matricula
    public function edit(Matricula $matricula)
    {
        Gate::authorize('admin-promotor');
        return view('matricula.edit', compact('matricula'));
    }

    //Actualizar matricula
    public function update(UpdateMatriculaRequest $request, Matricula $matricula)
    {
        Gate::authorize('admin-promotor');
        $matricula->update($request->all());
        return redirect()->route('matriculas.index')->with('info', 'ok');
    }
}
