<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreGrupoRequest;
use App\Http\Requests\UpdateGrupoRequest;
use App\Models\Grupo;
use App\Models\Curso;
use App\Models\Docente;
use App\Models\GrupoMatricula;
use App\Models\Matricula;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class GrupoController extends Controller
{
    //
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

        $sucursal = Auth::user()->sucursal;

        switch (true) {
            case ($sucursal == 'CH'):
                $grupos = Grupo::where('sucursal', 'CH')
                ->with(['curso:id,nombre','docente:id,nombre'])
                ->get(['id', 'horario', 'sucursal', 'anyo', 'curso_id', 'docente_id']);
                break;

            case ($sucursal == 'MG'):
                $grupos = Grupo::where('sucursal', 'MG')
                ->with(['curso:id,nombre','docente:id,nombre'])
                ->get(['id', 'horario', 'sucursal', 'anyo', 'curso_id', 'docente_id']);
                break;

            default:
                $grupos = Grupo::with(['curso:id,nombre','docente:id,nombre'])
                ->get(['id', 'horario', 'sucursal', 'anyo', 'curso_id', 'docente_id']);
                break;
        }
        return view('grupo.index', compact('grupos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $sucursal = Auth::user()->sucursal;

        //Cursos deben cargarse todos mientras esten activos
        $cursos = Curso::where('estado', '1')->get(['id', 'nombre']);

        switch (true) {
            case ($sucursal == 'CH'):
                $docentes = Docente::where('estado', '1')->where('sucursal', 'CH')->get(['id', 'nombre']);
                break;

            case ($sucursal == 'MG'):
                $docentes = Docente::where('estado', '1')->where('sucursal', 'MG')->get(['id', 'nombre']);
                break;

            default:
                $docentes = Docente::where('estado', '1')->get(['id', 'nombre']);
                break;
        }

        return view('grupo.create', compact('cursos', 'docentes'));
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
    public function show($grupo_id)
    {
        //
        $grupo = Grupo::with('matriculas:id,carnet,nombre')->where('id', $grupo_id)->first(['id']);
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
        //Cargar todos los docentes
        $docentes = Docente::where('estado', '1')->where('sucursal', $grupo->sucursal)->get(['id', 'nombre']);
        
        //Cantidad de grupos en la tabla pivot
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
