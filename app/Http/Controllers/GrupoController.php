<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreGrupoRequest;
use App\Http\Requests\UpdateGrupoRequest;
use App\Models\Grupo;
use App\Models\Curso;
use App\Models\Docente;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use App\Models\Inscripcion;

class GrupoController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    //Ver todos los grupos
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
                $grupos = Grupo::getGruposDocente($docente->id);
                break;

            default:
                $grupos = Grupo::getGruposSucursal($user->sucursal);
                break;
        }

        return view('grupo.index', compact('grupos'));
    }

    //Crear un nuevo grupo
    public function create()
    {
        Gate::authorize('admin');
        $sucursal = Auth::user()->sucursal;
        $cursos = Curso::getCursosActivos();

        $docentes = $sucursal == 'all' ?
            Docente::getDocentesActivos() :
            Docente::getDocentesActivosSucursal($sucursal);

        return view('grupo.create', compact('cursos', 'docentes'));
    }

    //Guardar docente
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
        $alumnos = Inscripcion::getByGrupo($grupo_id);
        return view('grupo.show', compact('alumnos', 'grupo_id'));
    }

    //Editar grupo
    public function edit($grupo_id)
    {
        Gate::authorize('admin');
        $grupo = Grupo::loadThis($grupo_id);
        $docentes = Docente::getDocentesActivosSucursal($grupo->sucursal);
        return view('grupo.edit', compact('grupo', 'docentes'));
    }

    //Actualizar grupo
    public function update(UpdateGrupoRequest $request, Grupo $grupo)
    {
        Gate::authorize('admin');
        $grupo->update($request->all());
        return redirect()->route('grupos.index')->with('info', 'ok');
    }

    //Eliminar un grupo
    public function destroy(Grupo $grupo)
    {
        Gate::authorize('admin');
        $grupo->delete();
        return redirect()->route('grupos.index')->with('info', 'eliminado');
    }
}
