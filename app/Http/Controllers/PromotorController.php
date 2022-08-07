<?php

namespace App\Http\Controllers;

use App\Models\Promotor;
use App\Models\Matricula;
use App\Services\FormattingRequest;
use App\Http\Requests\PromotorRequest;
use App\Services\Info;

class PromotorController extends Controller
{
    //Ver todos los promotores
    public function index()
    {
        $promotors = Promotor::orderBy('nombre')->get();
        return view('promotor.index', compact('promotors'));
    }

    //Crear un nuevo promotor
    public function create()
    {
        return view('promotor.create');
    }

    //Guardar nuevo promotor
    public function store(PromotorRequest $request)
    {
        $formated = (new FormattingRequest)->promotor($request);
        Promotor::create($formated->all());
        return redirect()->route('promotores.index')->with('success', config('app.created'));
    }

    //Ver matriculas de un promotor
    public function show($promotor_id)
    {
        $matriculas = Matricula::promotor($promotor_id);
        $info = (new Info)->promotor($matriculas);
        return view('promotor.show', compact('matriculas', 'info'));
    }

    //Editar promotor
    public function edit(Promotor $promotor)
    {
        return view('promotor.edit', compact('promotor'));
    }

    //Actualizar promotor
    public function update(PromotorRequest $request, Promotor $promotor)
    {
        $promotor->update($request->all());
        return redirect()->route('promotores.index')->with('success', config('app.updated'));
    }

    //Eliminar promotor
    public function destroy(Promotor $promotor)
    {
        $promotor->delete();
        return redirect()->route('promotores.index')->with('success', config('app.deleted'));
    }
}
