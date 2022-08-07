<?php

namespace App\Http\Controllers;

use App\Models\Matricula;
use Illuminate\Http\Request;

class CajaController extends Controller
{
    //Ventana principal de caja
    public function index()
    {
        return view('caja.index');
    }

    //Buscar alumno por carnet o nombre
    public function buscar(Request $request)
    {
        $request->validate([
            'buscar' => 'required'
        ]);
        
        $matriculas = Matricula::buscar($request);
        return redirect()->route('caja.index')->with('matriculas', $matriculas);
    }
}
