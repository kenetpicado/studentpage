<?php

namespace App\Http\Controllers;

use App\Services\Info;

class HomeController extends Controller
{
    public function index()
    {
        switch (auth()->user()->rol) {
            case 'alumno':
                return redirect()->route('consulta.index');
                break;
            case 'docente':
                return redirect()->route('grupos.index');
                break;
            case 'promotor':
                return redirect()->route('matriculas.index');
                break;
            default:
                $info = (new Info)->home();
                return view('index', compact('info'));
                break;
        }
    }
}
