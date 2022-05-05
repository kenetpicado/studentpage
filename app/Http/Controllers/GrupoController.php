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
use Illuminate\Http\Request;
use App\Http\Requests\InscribirRequest;

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
        //Gate::authorize('admin');

        $user = Auth::user();

        switch (true) {
            case ($user->sucursal == 'all' || $user->sucursal == 'admin'):
                $grupos = Grupo::with(['curso:id,nombre', 'docente:id,nombre'])
                    ->get(['id', 'horario', 'sucursal', 'anyo', 'curso_id', 'docente_id']);
                break;

                //Si es docente solo cargar sus propios grupos
            case ($user->rol == 'docente'):
                $id = Docente::where('carnet', $user->email)->first('id')->id;

                $grupos = Grupo::where('docente_id', $id)
                    ->with(['curso:id,nombre', 'docente:id,nombre'])
                    ->get(['id', 'horario', 'sucursal', 'anyo', 'curso_id', 'docente_id']);
                break;

            default:
                $grupos = Grupo::where('sucursal', $user->sucursal)
                    ->with(['curso:id,nombre', 'docente:id,nombre'])
                    ->get(['id', 'horario', 'sucursal', 'anyo', 'curso_id', 'docente_id']);
                break;
        }

        return view('grupo.index', compact('grupos'));
    }

    //Mostrar formulario de cambio de grupo
    public function seleccionar($matricula_id, $grupo_id)
    {
        //pivotv - grupomatricula
        $pivot = GrupoMatricula::where('grupo_id', $grupo_id)
            ->where('matricula_id', $matricula_id)
            ->with('grupo:id,sucursal,curso_id')
            ->first();

        //Cargar los grupos destino de la misma sucursal y del mismo curso
        $grupos = Grupo::where('sucursal', $pivot->grupo->sucursal) //Misma suscursal
            ->where('curso_id', $pivot->grupo->curso_id) //mismo curso
            ->where('anyo', date('Y')) //anyo actual
            ->where('id', '!=', $grupo_id) //excluir id actual
            ->with('curso:id,nombre', 'docente:id,nombre') //con relaciones
            ->get(['id', 'horario', 'curso_id', 'docente_id']); //parametros

        return view('grupo.cambiar', compact('pivot', 'grupos', 'grupo_id'));
    }

    //Actualizar nuevo grupo
    public function cambiar(InscribirRequest $request, $pivot_id)
    {
        $pivot = GrupoMatricula::find($pivot_id);
        $pivot->update($request->all());
        return redirect()->route('grupos.show', $request->oldgrupo)->with('info', 'ok');
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
            case ($sucursal == 'all'):
                $docentes = Docente::where('estado', '1')->get(['id', 'nombre']);
                break;

            default:
                $docentes = Docente::where('estado', '1')
                    ->where('sucursal', $sucursal)
                    ->get(['id', 'nombre']);
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
        return redirect()->route('grupos.index')->with('info', 'ok');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Grupo  $grupo
     * @return \Illuminate\Http\Response
     */
    public function show($grupo_id)
    {
        $grupo = GrupoMatricula::where('grupo_id', $grupo_id)
            ->with('matricula:id,carnet,nombre')
            ->get();

        return view('grupo.show', compact('grupo', 'grupo_id'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Grupo  $grupo
     * @return \Illuminate\Http\Response
     */
    public function edit($grupo_id)
    {
        //Cargar grupo con el docente
        $grupo = Grupo::with('docente:id,nombre')
            ->withCount('grupo_matricula')
            ->find($grupo_id);

        //Cargar todos los docentes
        $docentes = Docente::where('estado', '1')
            ->where('sucursal', $grupo->sucursal)
            ->get(['id', 'nombre']);

        return view('grupo.edit', compact('grupo', 'docentes'));
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
        return redirect()->route('grupos.index')->with('info', 'ok');
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
        return redirect()->route('grupos.index')->with('info', 'eliminado');
    }
}
