<?php

namespace App\Http\Controllers;

use App\Models\Matricula;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CajaController extends Controller
{
    public function index()
    {
        return view('caja.index');
    }

    public function buscar(Request $request)
    {
        $request->validate([
            'buscar' => 'required'
        ]);
        $matriculas = Matricula::buscar($request);
        return redirect()->route('caja.index')->with('matriculas', $matriculas);
    }
}
