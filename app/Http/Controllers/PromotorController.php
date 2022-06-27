<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePromotorRequest;
use App\Http\Requests\UpdatePromotorRequest;
use App\Models\Promotor;
use App\Models\User;
use App\Models\Matricula;
use App\Services\FormattingRequest;

class PromotorController extends Controller
{
    //Ver todos los promotores
    public function index()
    {
        $promotors = Promotor::orderBy('nombre')->get();
        return view('promotor.index', compact('promotors'));
    }

    //Guardar nuevo promotor
    public function store(StorePromotorRequest $request)
    {
        $formated = (new FormattingRequest)->promotor($request);
 
        $promotor = Promotor::create($formated->all());
        (new UserController)->store($formated, $promotor->id);
        return back()->with('success', 'Guardado');
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
    public function update(UpdatePromotorRequest $request, Promotor $promotor)
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
