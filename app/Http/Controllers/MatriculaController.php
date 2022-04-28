<?php

namespace App\Http\Controllers;

use App\Http\Requests\InscribirRequest;
use App\Http\Requests\StoreMatriculaRequest;
use App\Http\Requests\UpdateMatriculaRequest;
use App\Models\Matricula;
use App\Models\Grupo;
use App\Models\Promotor;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class MatriculaController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    //Form para seleccionar grupo a inscribir
    public function seleccionar($matricula_id)
    {
        $matricula = Matricula::find($matricula_id, ['id', 'sucursal', 'nombre']);

        //Cargar todos los grupos disponibles de la sucursal dada
        $grupos = Grupo::where('sucursal', $matricula->sucursal)
            ->where('anyo', date('Y'))
            ->with(['docente:id,nombre', 'curso:id,nombre'])
            ->get(['id', 'horario', 'curso_id', 'docente_id']);

        return view('matricula.inscribir', compact('matricula', 'grupos'));
    }

    //Ejecutar inscripcion
    public function inscribir(InscribirRequest $request, $matricula_id)
    {
        $matricula = Matricula::find($matricula_id, ['id', 'inscrito']);

        $matricula->grupos()->attach($request->grupo_id);

        $matricula->update(['inscrito' => '1']);
        return redirect()->route('matriculas.index')->with('info', 'ok');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        Gate::authorize('matricula');

        $user = Auth::user();

        switch (true) {
            case ($user->rol == 'promotor'):
                $id = Promotor::where('carnet', $user->email)->first(['id'])->id;

                $matriculas = Matricula::where('promotor_id', $id)
                    ->where('anyo', date('Y'))
                    ->with(['promotor:id,carnet'])
                    ->get(['id', 'carnet', 'nombre', 'created_at', 'promotor_id', 'inscrito']);
                break;

            case ($user->rol == 'admin' && $user->sucursal == 'CH'):
                $matriculas = Matricula::where('sucursal', 'CH')
                    ->with(['promotor:id,carnet'])
                    ->get(['id', 'carnet', 'nombre', 'created_at', 'promotor_id', 'inscrito']);
                break;

            case ($user->rol == 'admin' && $user->sucursal == 'MG'):
                $matriculas = Matricula::where('sucursal', 'MG')
                    ->with(['promotor:id,carnet'])
                    ->get(['id', 'carnet', 'nombre', 'created_at', 'promotor_id', 'inscrito']);
                break;

            default:
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
        Gate::authorize('matricula');

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

        //Agregar campos que faltan
        $request->merge([
            'carnet' =>  $carnet,
            'pin' => Generate::pin(),
            'promotor_id' => $id,
        ]);

        //Guardar datos
        Matricula::create($request->all());

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
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Matricula  $matricula
     * @return \Illuminate\Http\Response
     */
    public function edit(Matricula $matricula)
    {
        Gate::authorize('matricula');
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
        Gate::authorize('matricula');

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
