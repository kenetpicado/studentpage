<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreGrupoRequest;
use App\Http\Requests\UpdateGrupoRequest;
use App\Models\Grupo;
use App\Models\Curso;
use App\Models\Docente;
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
        $cursos = Curso::where('estado', '=', '1')->get();

        $sucursal = Auth::user()->sucursal;

        switch (true) {
            case ($sucursal == 'CH'):
                $docentes = Docente::where('estado', '=', '1')->where('sucursal', '=', 'CH')->get();
                $grupos = Grupo::where('sucursal', '=', 'CH')->get();
                break;
            case ($sucursal == 'MG'):
                $docentes = Docente::where('estado', '=', '1')->where('sucursal', '=', 'MG')->get();
                $grupos = Grupo::where('sucursal', '=', 'MG')->get();
                break;
            default:
                $docentes = Docente::where('estado', '=', '1')->get();
                $grupos = Grupo::all();
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
        //OBTENER DATOS PARA VALIDAR
        $curso_id = $request->curso_id;
        $curso = Curso::find($curso_id);

        //VALIRDAR QUE NO HAYA OTRO GRUPO DEL MISMO CURSO EN LA MISMA SUCURSAL
        $request->validate(
            [
                'numero' => Rule::unique('grupos')->where(function ($query) use ($curso_id, $request) {
                    return $query->where('curso_id', $curso_id)->where('sucursal', $request->sucursal);
                }),
            ],
            [
                'numero.unique' => 'Ya existe un ' . $request->numero . ' del curso ' . $curso->nombre
            ]
        );

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
        $docentes = Docente::all();
        return view('grupo.edit', compact('grupo', $grupo), compact('docentes', $docentes));
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
    }
}
