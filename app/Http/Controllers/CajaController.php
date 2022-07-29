<?php

namespace App\Http\Controllers;

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
            'carnet' => 'required'
        ]);

        $matriculas = DB::table('matriculas')
            ->where('carnet', 'LIKE', '%' . $request->carnet . '%')
            ->select(['id', 'nombre', 'carnet'])
            ->get();

        return redirect()->route('caja.index')->with('matriculas', $matriculas);
    }
}
