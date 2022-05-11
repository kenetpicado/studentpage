<?php

namespace App\Http\Controllers;

use App\Http\Requests\InscribirRequest;
use App\Http\Requests\StoreMatriculaRequest;
use App\Http\Requests\UpdateMatriculaRequest;
use App\Mail\VerMatricula;
use App\Models\Matricula;
use App\Models\Grupo;
use App\Models\GrupoMatricula;
use App\Models\Promotor;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class MatriculaController extends Controller
{
    
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    //Form para seleccionar grupo a inscribir
    public function seleccionar($matricula_id)
    {
        Gate::authorize('admin');

        $matricula = Matricula::find($matricula_id, ['id', 'sucursal']);

        //Cargar todos los grupos disponibles de la sucursal dada
        $grupos = Grupo::where('sucursal', $matricula->sucursal)
            ->where('anyo', date('Y'))
            ->with(['docente:id,nombre', 'curso:id,nombre'])
            ->get(['id', 'horario', 'curso_id', 'docente_id']);

        return view('matricula.inscribir', compact('matricula', 'grupos'));
    }

    //Ejecutar inscripcion
    public function inscribir(InscribirRequest $request)
    {
        Gate::authorize('admin');

        GrupoMatricula::create($request->all());

        Matricula::find($request->matricula_id, ['id', 'inscrito'])
            ->update(['inscrito' => '1']);

        return redirect()->route('matriculas.index')->with('info', 'ok');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        Gate::authorize('admin-promotor');

        $user = Auth::user();

        switch (true) {
                //Si es un promotor
            case ($user->rol == 'promotor'):
                $id = Promotor::where('carnet', $user->email)->first(['id'])->id;

                $matriculas = Matricula::where('promotor_id', $id)
                    ->where('anyo', date('Y'))
                    ->with(['promotor:id,carnet'])
                    ->get(['id', 'carnet', 'nombre', 'created_at', 'promotor_id', 'inscrito']);
                break;

                //Si es admin y de una sucursal especifica
            case ($user->rol == 'admin' && $user->sucursal != 'all'):
                $matriculas = Matricula::where('sucursal', $user->sucursal)
                    ->with(['promotor:id,carnet'])
                    ->get(['id', 'carnet', 'nombre', 'created_at', 'promotor_id', 'inscrito']);
                break;

            default:
                //Si es root
                $matriculas = Matricula::with(['promotor:id,carnet'])
                    ->get(['id', 'carnet', 'nombre', 'created_at', 'promotor_id', 'inscrito']);
                break;
        }

        return view('matricula.index', compact('matriculas', 'user'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreMatriculaRequest  $request
     * @return \Illuminate\Http\Response
     */
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

        //Guardar cuenta de usuario
        User::create([
            'name' => $request->nombre,
            'email' => $carnet,
            'password' => Hash::make($pin),
            'rol' => 'alumno',
            'sucursal' => $request->sucursal
        ]);

        //MOSTRAR VISTA
        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Matricula  $matricula
     * @return \Illuminate\Http\Response
     */
    public function show(Matricula $matricula)
    {
        Gate::authorize('admin-promotor');
        //
        return new VerMatricula($matricula);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Matricula  $matricula
     * @return \Illuminate\Http\Response
     */
    public function edit(Matricula $matricula)
    {
        Gate::authorize('admin-promotor');

        return view('matricula.edit', compact('matricula'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateMatriculaRequest  $request
     * @param  \App\Models\Matricula  $matricula
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateMatriculaRequest $request, Matricula $matricula)
    {
        Gate::authorize('admin-promotor');

        $matricula->update($request->all());
        return redirect()->route('matriculas.index')->with('info', 'ok');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Matricula  $matricula
     * @return \Illuminate\Http\Response
     */
    public function destroy(Matricula $matricula)
    {
        //
    }
}
