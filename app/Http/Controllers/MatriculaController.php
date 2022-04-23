<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreMatriculaRequest;
use App\Http\Requests\UpdateMatriculaRequest;
use App\Models\Matricula;
use App\Models\Grupo;
use App\Models\Promotor;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use App\Models\GrupoMatricula;
use App\Models\Nota;
use Illuminate\Validation\Rule;
use Symfony\Component\ErrorHandler\Debug;

class MatriculaController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    //Inscribir a un curso
    public function inscribir(Matricula $matricula)
    {
        $grupos = Grupo::where('sucursal', $matricula->sucursal)->get();
        return view('matricula.inscribir', compact('matricula', 'grupos'));
    }

    //Agregar nota
    public function agregar($matricula_id, $grupo_id)
    {
        $matricula = Matricula::find($matricula_id, ['id', 'nombre']);
        
        //Obtener el grupo en la tabla pivot
        $mt = GrupoMatricula::where('grupo_id', $grupo_id)->where('matricula_id', $matricula->id)->first('id');
        
        //Obtener las notas
        $notas = Nota::where('grupo_matricula_id', $mt->id)->get(['created_at', 'unidad', 'valor']);
        return view('nota.create', compact('matricula', 'mt', 'notas'));
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
                
                $matriculas = Matricula::where('promotor_id', $id)->with([
                    'promotor' => function ($query) {
                        $query->select('id', 'carnet');
                    }
                ])->get(['id', 'carnet', 'nombre', 'created_at', 'promotor_id', 'inscrito']);
                break;

            case ($user->rol == 'admin' && $user->sucursal == 'CH'):
                $matriculas = Matricula::where('sucursal', 'CH')->with([
                    'promotor' => function ($query) {
                        $query->select('id', 'carnet');
                    }
                ])->get(['id', 'carnet', 'nombre', 'created_at', 'promotor_id', 'inscrito']);
                break;

            case ($user->rol == 'admin' && $user->sucursal == 'MG'):
                $matriculas = Matricula::where('sucursal', 'MG')->with([
                    'promotor' => function ($query) {
                        $query->select('id', 'carnet');
                    }
                ])->get(['id', 'carnet', 'nombre', 'created_at', 'promotor_id', 'inscrito']);
                break;

            default:
                $matriculas = Matricula::with([
                    'promotor' => function ($query) {
                        $query->select('id', 'carnet');
                    }
                ])->get(['id', 'carnet', 'nombre', 'created_at', 'promotor_id', 'inscrito']);
                break;
        }

        return view('matricula.index', compact('matriculas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
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

        //Si es admin de sucursal especifica
        $user = Auth::user();

        if ($user->sucursal != 'all') {
            $request->merge([
                'sucursal' =>  $user->sucursal,
            ]);
        } else {
            $request->validate([
                'sucursal' => 'required',
            ]);
        }

        //Si matricula un admin id promotor es null
        $id = $user->rol == 'admin' ? null : Promotor::where('carnet', '=', $user->email)->first(['id'])->id;

        //Agregar campos que faltan
        $request->merge([
            'carnet' =>  Generate::idEstudiante($request->sucursal . '04', $request->fecha_nac),
            'pin' => Generate::pin(),
            'promotor_id' => $id,
        ]);

        //Guardar datos
        $matricula = Matricula::create($request->all());

        //MOSTRAR VISTA
        return redirect()->route('matricula.inscribir', compact('matricula'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Matricula  $matricula
     * @return \Illuminate\Http\Response
     */
    public function show(Matricula $matricula)
    {
        Gate::authorize('matricula');
        return view('matricula.show', compact('matricula'));
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

        //si hay flag de inscribir a grupo
        if ($request->has('inscribir')) {
            $request->validate([
                'grupo_id' => ['required', Rule::unique('grupo_matricula')->where(function ($query) use ($matricula) {
                    return $query->where('matricula_id', $matricula->id);
                })],
            ], [
                'grupo_id.unique' => 'Ya pertenece a este grupo'
            ], [
                'grupo_id' => 'grupo'
            ]);

            $matricula->grupos()->attach($request->grupo_id);
            $matricula->update(['inscrito' => '1']);
        }
        //si es actualizacion de datos
        else {
            $request->validate([
                'nombre' => 'required|max:45',
                'cedula' => 'nullable|alpha_dash|min:16|max:16',
                'fecha_nac' => 'required|date',
                'tel' => 'nullable|min:8|max:8',
                'grado' => 'required|max:45',
            ], [], [
                'fecha_nac' => 'fecha de nacimiento',
                'tel' => 'telefono',
            ]);

            //agregar datos menos el flag
            $matricula->update($request->except('inscribir'));
        }

        return redirect()->route('matricula.index')->with('info', 'ok');
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
