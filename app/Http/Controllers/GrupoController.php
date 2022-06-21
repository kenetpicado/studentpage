<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreGrupoRequest;
use App\Http\Requests\UpdateGrupoRequest;
use App\Models\Grupo;
use App\Models\Curso;
use App\Models\Docente;
use App\Models\User;
use Illuminate\Support\Facades\Gate;
use App\Models\Inscripcion;

class GrupoController extends Controller
{
    //Ver todos los grupos
    public function index()
    {
        Gate::authorize('admin-docente');

        switch (true) {

            case (auth()->user()->sucursal == 'all'):
                $grupos = Grupo::getGrupos();
                break;

            case (auth()->user()->rol == 'docente'):
                $docente = User::getUserByCarnet(new Docente());
                $grupos = Grupo::getGruposDocente($docente->id);
                break;

            default:
                $grupos = Grupo::getGruposSucursal();
                break;
        }

        return view('grupo.index', compact('grupos'));
    }

    //Ver grupos terminados
    public function showClosed()
    {
        switch (true) {
            case (auth()->user()->sucursal == 'all'):
                $grupos = Grupo::getGrupos('0');
                break;
            default:
                $grupos = Grupo::getGruposSucursal('0');
                break;
        }

        return view('terminado.index', compact('grupos'));
    }

    //Crear un nuevo grupo
    public function create()
    {
        Gate::authorize('admin');

        $cursos = Curso::getCursosActivos();

        $docentes = auth()->user()->sucursal == 'all'
            ? Docente::getDocentesActivos()
            : Docente::getDocentesActivosSucursal(auth()->user()->sucursal);

        return view('grupo.create', compact('cursos', 'docentes'));
    }

    //Guardar grupo
    public function store(StoreGrupoRequest $request)
    {
        Gate::authorize('admin');

        //Sucursal del grupo = suscursal del docente
        $request->merge([
            'sucursal' => Docente::find($request->docente_id)->sucursal,
            'anyo' => now()->format('Y'),
        ]);

        Grupo::create($request->all());
        return redirect()->route('grupos.index')->with('info', config('app.add'));
    }

    //Mostrar alumnos de un grupo
    public function show($grupo_id)
    {
        Gate::authorize('admin-docente');
        $inscripciones = Inscripcion::getByGrupo($grupo_id);
        return view('grupo.show', compact('inscripciones', 'grupo_id'));
    }

    //Ver alumnos de un grupo terminado
    public function showThisClosed($grupo_id)
    {
        $alumnos = Inscripcion::getByGrupo($grupo_id);
        return view('terminado.show', compact('alumnos', 'grupo_id'));
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
        return redirect()->route('grupos.index')->with('info', config('app.update'));
    }

    //Cambiar estado del grupo
    public function status($grupo_id)
    {
        Gate::authorize('admin');
        $grupo = Grupo::find($grupo_id, ['id', 'activo']);

        $activo = $grupo->activo == '1' ? '0' : '1';
        $grupo->update(['activo' => $activo]);

        return redirect()->route('grupos.index')->with('info', config('app.update'));
    }

    //Eliminar un grupo
    public function destroy(Grupo $grupo)
    {
        Gate::authorize('admin');

        if ($grupo->inscripciones()->count() > 0)
            return redirect()->route('grupos.edit', $grupo->id)->with('message', config('app.undeleted'));

        $grupo->delete();
        return redirect()->route('grupos.index')->with('deleted', config('app.deleted'));
    }
}
