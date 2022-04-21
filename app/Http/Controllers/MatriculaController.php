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
    public function agregar(Matricula $matricula, $grupo_id)
    {
        $mt = GrupoMatricula::where('grupo_id', $grupo_id)->where('matricula_id', $matricula->id)->first();
        return view('nota.create', compact('matricula', 'mt'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        Gate::authorize('matricula');

        $rol = Auth::user()->rol;
        $sucursal = Auth::user()->sucursal;

        switch (true) {
            case ($rol == 'promotor'):
                $matriculas = Promotor::where('carnet', '=', Auth::user()->email)->first()->matriculas;
                break;
            case ($rol == 'admin' && $sucursal == 'CH'):
                $matriculas = Matricula::where('sucursal', '=', 'CH')->get();
                break;
            case ($rol == 'admin' && $sucursal == 'MG'):
                $matriculas = Matricula::where('sucursal', '=', 'MG')->get();
                break;
            default:
                $matriculas = Matricula::all();
                break;
        }

        $grupos = Grupo::all();
        return view('matricula.index', compact('matriculas', 'grupos'));
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
        $sucursal = Auth::user()->sucursal;

        if ($sucursal != 'all') {
            $request->merge([
                'sucursal' =>  $sucursal,
            ]);
        } else {
            $request->validate([
                'sucursal' => 'required',
            ]);
        }

        //Encontrar el promotor quien matricula
        $promotor = Promotor::where('carnet', '=', Auth::user()->email)->first();

        //Si matricula un admin el campo id promotor es null
        $id = !$promotor ? null : $promotor->id;

        //Agregar campos que faltan
        $request->merge([
            'carnet' =>  Generate::idEstudiante($request->sucursal . '04', $request->fecha_nac),
            'pin' => Generate::pin(),
            'promotor_id' => $id,
        ]);

        //Guardar datos
        Matricula::create($request->all());

        //MOSTRAR VISTA
        return redirect()->route('matricula.index')->with('info', 'ok');
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

        $grupos = Grupo::all();
        return view('matricula.edit', compact('matricula', $matricula), compact('grupos', $grupos));
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
                'grupo_id' => 'required',
            ], [], [
                'grupo_id' => 'grupo'
            ]);

            $matricula->grupos()->attach($request->grupo_id);
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
