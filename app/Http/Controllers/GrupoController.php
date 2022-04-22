<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreGrupoRequest;
use App\Http\Requests\UpdateGrupoRequest;
use App\Models\Grupo;
use App\Models\Curso;
use App\Models\Docente;
use App\Models\GrupoMatricula;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class GrupoController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        Gate::authorize('admin');

        //Cursos deben cargarse todos
        $cursos = Curso::where('estado', '=', '1')->get(['id', 'nombre']);

        $sucursal = Auth::user()->sucursal;

        switch (true) {
            case ($sucursal == 'CH'):
                $docentes = Docente::where('estado', '=', '1')->where('sucursal', '=', 'CH')->get(['id', 'nombre']);
                
                $grupos = Grupo::where('sucursal', '=', 'CH')->with([
                    'curso' => function ($query) {
                        $query->select('id', 'nombre');
                    },
                    'docente' => function ($query) {
                        $query->select('id', 'nombre');
                    },
                ])->get(['id', 'horario', 'sucursal', 'anyo', 'curso_id', 'docente_id']);
                break;

            case ($sucursal == 'MG'):
                $docentes = Docente::where('estado', '=', '1')->where('sucursal', '=', 'MG')->get(['id', 'nombre']);
                $grupos = Grupo::where('sucursal', '=', 'MG')->with([
                    'curso' => function ($query) {
                        $query->select('id', 'nombre');
                    },
                    'docente' => function ($query) {
                        $query->select('id', 'nombre');
                    },
                ])->get(['id', 'horario', 'sucursal', 'anyo', 'curso_id', 'docente_id']);
                break;

            default:
                $docentes = Docente::where('estado', '=', '1')->get(['id', 'nombre']);
                
                $grupos = Grupo::with([
                    'curso' => function ($query) {
                        $query->select('id', 'nombre');
                    },
                    'docente' => function ($query) {
                        $query->select('id', 'nombre');
                    },
                ])->get(['id', 'horario', 'sucursal', 'anyo', 'curso_id', 'docente_id']);
                break;
        }
        return view('grupo.index', compact('grupos', 'cursos', 'docentes'));
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
     * @param  \App\Http\Requests\StoreGrupoRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreGrupoRequest $request)
    {
        //Se crear sucursal del grupo en funcion de la suscursal del docente
        $request->merge([
            'sucursal' => Docente::find($request->docente_id)->sucursal,
        ]);
        
        Grupo::create($request->all());
        return redirect()->route('grupo.index')->with('info', 'ok');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Grupo  $grupo
     * @return \Illuminate\Http\Response
     */
    public function show(Grupo $grupo)
    {
        //
        return view('grupo.show', compact('grupo'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Grupo  $grupo
     * @return \Illuminate\Http\Response
     */
    public function edit(Grupo $grupo)
    {
        //
        $docentes = Docente::where('sucursal', $grupo->sucursal)->get(['id', 'nombre']);
        $cant = GrupoMatricula::where('grupo_id', $grupo->id)->count();

        return view('grupo.edit', compact('grupo', 'docentes', 'cant'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateGrupoRequest  $request
     * @param  \App\Models\Grupo  $grupo
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateGrupoRequest $request, Grupo $grupo)
    {
        //
        $grupo->update($request->all());
        return redirect()->route('grupo.index')->with('info', 'ok');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Grupo  $grupo
     * @return \Illuminate\Http\Response
     */
    public function destroy(Grupo $grupo)
    {
        //
        $grupo->delete();
        return redirect()->route('grupo.index')->with('info', 'eliminado');
    }
}
