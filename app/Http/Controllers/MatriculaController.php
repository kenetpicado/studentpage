<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreMatriculaRequest;
use App\Http\Requests\UpdateMatriculaRequest;
use App\Models\Matricula;
use App\Models\Grupo;
use App\Models\Promotor;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;


class MatriculaController extends Controller
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

        $matricula->update($request->all());
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
