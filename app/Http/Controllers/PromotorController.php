<?php

namespace App\Http\Controllers;

use App\Models\Promotor;
use App\Models\Matricula;
use App\Services\FormattingRequest;
use App\Http\Requests\PromotorRequest;

class PromotorController extends Controller
{
    //Ver todos los promotores
    public function index()
    {
        $promotors = Promotor::orderBy('nombre')->get();
        return view('promotor.index', compact('promotors'));
    }

    public function create()
    {
        return view('promotor.create');
    }

    //Guardar nuevo promotor
    public function store(PromotorRequest $request)
    {
        $formated = (new FormattingRequest)->promotor($request);

        $promotor = Promotor::create($formated->all());
        (new UserController)->store($formated, $promotor->id);
        return redirect()->route('promotores.index')->with('success', 'Promotor guardado correctamente');
    }

    //Ver matriculas de un promotor
    public function show($promotor_id)
    {
        $matriculas = Matricula::toPromotorShow($promotor_id);
        return view('promotor.show', compact('matriculas'));
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
        (new UserController)->update($promotor);
        return redirect()->route('promotores.index')->with('success', 'Actualizado');
    }

    //Eliminar promotor
    public function destroy(Promotor $promotor)
    {
        (new UserController)->destroy($promotor->carnet);
        $promotor->delete();
        return redirect()->route('promotores.index')->with('success', 'Eliminado');
    }
}
