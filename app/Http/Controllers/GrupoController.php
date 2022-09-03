<?php

namespace App\Http\Controllers;

use App\Models\Curso;
use App\Models\Grupo;
use App\Models\Docente;
use App\Models\Inscripcion;
use App\Http\Requests\GrupoRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;

class GrupoController extends Controller
{
    //Ver todos los grupos
    public function index()
    {
        $grupos = Grupo::index();
        return view('grupo.index', compact('grupos'));
    }

    //Crear un nuevo grupo
    public function create()
    {
        if (Gate::denies('create_grupo'))
            return back()->with('error', config('app.denies'));

        $cursos = Curso::activos();
        $docentes = Docente::createGrupo();
        return view('grupo.create', compact('cursos', 'docentes'));
    }

    //Guardar grupo
    public function store(GrupoRequest $request)
    {
        $request->merge([
            'sucursal' => Docente::find($request->docente_id)->sucursal
        ]);

        Grupo::create($request->all());
        return redirect()->route('grupos.index')->with('success', config('app.created'));
    }

    //Mostrar alumnos de un grupo
    public function show($grupo_id)
    {
        Gate::authorize('docente_autorizado', $grupo_id);
        $inscripciones = Inscripcion::getByGrupo($grupo_id);
        return view('grupo.show', compact('inscripciones', 'grupo_id'));
    }

    //Editar grupo
    public function edit(Grupo $grupo)
    {
        $curso = DB::table('cursos')->find($grupo->curso_id, ['id', 'nombre']);
        $docentes = Docente::sucursal($grupo->sucursal);
        return view('grupo.edit', compact('grupo', 'docentes', 'curso'));
    }

    //Actualizar grupo
    public function update(GrupoRequest $request, Grupo $grupo)
    {
        $grupo->update($request->all());
        return redirect()->route('grupos.index')->with('success', config('app.updated'));
    }

    //Eliminar un grupo
    public function destroy(Grupo $grupo)
    {
        if ($grupo->inscripciones()->count() > 0)
            return redirect()->route('grupos.edit', $grupo->id)->with('error', config('app.undeleted'));

        $grupo->delete();
        return redirect()->route('grupos.index')->with('success', config('app.deleted'));
    }

    //Ver grupos terminados
    public function index_closed()
    {
        $grupos = Grupo::index(0);
        return view('terminado.index', compact('grupos'));
    }

    //Ver alumnos de un grupo terminado
    public function show_closed($grupo_id)
    {
        $inscripciones = Inscripcion::getByGrupo($grupo_id);
        return view('terminado.show', compact('inscripciones', 'grupo_id'));
    }

    /* Cambiar estado del grupo */
    public function cambiar_estado($grupo_id)
    {
        $grupo = DB::table('grupos')->where('id', $grupo_id);
        $grupo->update([
            'activo' => $grupo->first()->activo == '1'  ? '0' : '1'
        ]);
        return redirect()->route('grupos.index')->with('success', config('app.updated'));
    }
}
