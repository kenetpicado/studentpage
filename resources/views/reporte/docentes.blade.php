@extends('reporte.layout')

@section('title', 'Docentes')

@section('content')
    <div class="card-title">
        <h4 class="text-center">REPORTE GENERAL DE DOCENTES</h4>

        <p>
            Docentes Chinandega: {{ $docentes->where('sucursal', 'CH')->count() }}
        </p>
        <p>
            Docentes Managua: {{ $docentes->where('sucursal', 'MG')->count() }}
        </p>
        <p>
            Total: {{ $docentes->count() }}
        </p>
    </div>
    <table class="table table-borderless table-striped" width="100%" cellspacing="0">
        <thead>
            <tr>
                <th>CARNET</th>
                <th>NOMBRE</th>
                <th>SUCURSAL</th>
                <th>ESTADO</th>
                <th class="small">GRUPOS</th>
                <th class="small">ACTIVOS</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($docentes as $docente)
                <tr>
                    <td>{{ $docente->carnet }}</td>
                    <td>{{ $docente->nombre }}</td>
                    <td>{{ $docente->sucursal == 'CH' ? 'Chinandega' : 'Managua' }}</td>
                    <td>{{ $docente->activo == '1' ? 'Activo' : '-'}}</td>
                    <td>{{ $docente->grupos->count() }}</td>
                    <td>{{ $docente->grupos->where('activo', '1')->count() }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
