<?php

namespace App\Http\Controllers;

use App\Models\Curso;
use App\Models\Grupo;
use App\Models\Docente;
use App\Models\Inscripcion;
use App\Http\Requests\GrupoRequest;
use Illuminate\Support\Facades\Gate;

class GrupoController extends Controller
{
    //Ver todos los grupos
    public function index()
    {
        switch (true) {

            case (auth()->user()->sucursal == 'all'):
                $grupos = Grupo::getGrupos();
                break;

            case (auth()->user()->rol == 'docente'):
                $grupos = Grupo::getGruposDocente(auth()->user()->sub_id);
                break;

            default:
                $grupos = Grupo::getGruposSucursal();
                break;
        }

        return view('grupo.index', compact('grupos'));
    }

    //Crear un nuevo grupo
    public function create()
    {
        $cursos = Curso::getCursosActivos();

        $docentes = auth()->user()->sucursal == 'all'
            ? Docente::getDocentesActivos()
            : Docente::getDocentesActivosSucursal(auth()->user()->sucursal);

        return view('grupo.create', compact('cursos', 'docentes'));
    }

    //Guardar grupo
    public function store(GrupoRequest $request)
    {
        //Sucursal del grupo = suscursal del docente
        $request->merge([
            'sucursal' => Docente::find($request->docente_id)->sucursal,
            'anyo' => now()->format('Y'),
        ]);

        Grupo::create($request->all());
        return redirect()->route('grupos.index')->with('success', 'Guardado');
    }

    //Mostrar alumnos de un grupo
    public function show($grupo_id)
    {
        Gate::authorize('docente_autorizado', $grupo_id);

        $inscripciones = Inscripcion::getByGrupo($grupo_id);
        return view('grupo.show', compact('inscripciones', 'grupo_id'));
    }

    //Editar grupo
    public function edit($grupo_id)
    {
        $grupo = Grupo::edit($grupo_id);
        $docentes = Docente::getDocentesActivosSucursal($grupo->sucursal);
        return view('grupo.edit', compact('grupo', 'docentes'));
    }

    //Actualizar grupo
    public function update(GrupoRequest $request, Grupo $grupo)
    {
        $grupo->update($request->all());
        return redirect()->route('grupos.index')->with('success', 'Actualizado');
    }

    //Eliminar un grupo
    public function destroy(Grupo $grupo)
    {
        if ($grupo->inscripciones()->count() > 0)
            return redirect()->route('grupos.edit', $grupo->id)->with('error', 'No es posible eliminar');

        $grupo->delete();
        return redirect()->route('grupos.index')->with('success', 'Eliminado');
    }

    //Ver grupos terminados
    public function showClosed()
    {
        $grupos = auth()->user()->sucursal == 'all'
            ? Grupo::getGrupos('0')
            : Grupo::getGruposSucursal('0');

        return view('terminado.index', compact('grupos'));
    }

    //Ver alumnos de un grupo terminado
    public function showThisClosed($grupo_id)
    {
        $inscripciones = Inscripcion::getByGrupo($grupo_id);
        return view('terminado.show', compact('inscripciones', 'grupo_id'));
    }

    //Activar grupo
    public function activarGrupo($grupo_id)
    {
        Grupo::status($grupo_id);
        return redirect()->route('grupos.index')->with('success', 'Actualizado');
    }

    //Desactivar grupo
    public function desactivarGrupo($grupo_id)
    {
        Grupo::status($grupo_id, '0');
        return redirect()->route('grupos.index')->with('success', 'Actualizado');
    }
}
