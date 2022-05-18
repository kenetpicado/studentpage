<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreGrupoRequest;
use App\Http\Requests\UpdateGrupoRequest;
use App\Models\Grupo;
use App\Models\Curso;
use App\Models\Docente;
use App\Models\User;
use App\Models\GrupoMatricula;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use App\Http\Requests\InscribirRequest;

class GrupoController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        Gate::authorize('admin-docente');

        $user = Auth::user();

        switch (true) {

            case ($user->sucursal == 'all'):
                $grupos = Grupo::getGrupos();
                break;

            case ($user->rol == 'docente'):
                $docente = User::getUserByCarnet(new Docente(), $user->email);
                $grupos = Grupo::getGrupoSDocente($docente->id);
                break;

            default:
                $grupos = Grupo::getGruposSucursal($user->sucursal);
                break;
        }

        return view('grupo.index', compact('grupos'));
    }

    //Mostrar formulario de cambio de grupo
    public function seleccionar($matricula_id, $grupo_id)
    {
        Gate::authorize('admin');

        //pivotv - grupomatricula
        $pivot = GrupoMatricula::where('grupo_id', $grupo_id)
            ->where('matricula_id', $matricula_id)
            ->with('grupo:id,sucursal,curso_id')
            ->first();

        //Cargar los grupos destino de la misma sucursal y del mismo curso
        $grupos = Grupo::getGruposCurrents($pivot->grupo->sucursal);

        return view('grupo.cambiar', compact('pivot', 'grupos', 'grupo_id'));
    }

    //Actualizar nuevo grupo
    public function cambiar(InscribirRequest $request, $pivot_id)
    {
        Gate::authorize('admin');
        GrupoMatricula::find($pivot_id)->update($request->all());
        return redirect()->route('grupos.show', $request->oldgrupo)->with('info', 'ok');
    }

    //Crear un nuevo grupo
    public function create()
    {
        Gate::authorize('admin');
        //
        $sucursal = Auth::user()->sucursal;

        $cursos = Curso::getCursosActivos();

        switch (true) {

            case ($sucursal == 'all'):
                $docentes = Docente::getDocentesActivos();
                break;

            default:
                $docentes = Docente::getDocentesActivosSucursal($sucursal);
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
        Gate::authorize('admin');

        //Sucursal del grupo = suscursal del docente
        $request->merge([
            'sucursal' => Docente::find($request->docente_id)->sucursal,
        ]);

        Grupo::create($request->all());
        return redirect()->route('grupos.index')->with('info', 'ok');
    }

    //Mostrar alumnos de un grupo
    public function show($grupo_id)
    {
        Gate::authorize('admin-docente');

        $grupo = GrupoMatricula::where('grupo_id', $grupo_id)
            ->with('matricula:id,carnet,nombre')
            ->get();

        return view('grupo.show', compact('grupo', 'grupo_id'));
    }

    //Editar grupo
    public function edit($grupo_id)
    {
        Gate::authorize('admin');

        //Cargar grupo con el docente
        $grupo = Grupo::with('docente:id,nombre')
            ->withCount('grupo_matricula')
            ->find($grupo_id);

        $docentes = Docente::getDocentesActivosSucursal($grupo->sucursal);

        return view('grupo.edit', compact('grupo', 'docentes'));
    }

    //Actualizar grupo
    public function update(UpdateGrupoRequest $request, Grupo $grupo)
    {
        Gate::authorize('admin');
        //
        $grupo->update($request->all());
        return redirect()->route('grupos.index')->with('info', 'ok');
    }

    //Eliminar un grupo
    public function destroy(Grupo $grupo)
    {
        Gate::authorize('admin');
        //
        $grupo->delete();
        return redirect()->route('grupos.index')->with('info', 'eliminado');
    }
}
