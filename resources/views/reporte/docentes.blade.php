@extends('reporte.layout')

@section('title', 'Docentes')

@section('content')
    <div class="card-title">
        <h4 class="text-center">REPORTE GENERAL DE DOCENTES</h4>
        <h5 class="text-center">Información general de Grupos asignados</h5>
        <hr>
        <p>
            Docentes Chinandega: {{ $docentes->where('sucursal', 'CH')->count() }}
        </p>
        <p>
            Docentes Managua: {{ $docentes->where('sucursal', 'MG')->count() }}
        </p>
        <p>
            Total: {{ $docentes->count() }}
        </p>
        <p>
            Se cuentan únicamente los grupos activos.
        </p>
    </div>
    <table class="table table-borderless table-striped align-middle" width="100%" cellspacing="0">
        <thead>
            <tr>
                <th>CARNET</th>
                <th>NOMBRE</th>
                <th>SUCURSAL</th>
                <th>GRUPOS</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($docentes as $docente)
                <tr>
                    <td>{{ $docente->carnet }}</td>
                    <td>{{ $docente->nombre }}</td>
                    <td>{{ $docente->sucursal }}</td>
                    <td>{{ $docente->grupos->count() }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
