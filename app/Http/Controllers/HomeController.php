<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
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
                return view('blank');
                break;
        }
    }

    public function __construct()
    {
        $this->middleware('auth');
    }
}
