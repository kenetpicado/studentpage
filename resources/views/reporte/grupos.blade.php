@extends('reporte.layout')

@section('title', 'Grupos')

@section('content')
    <div class="card-title">
        <h4 class="text-center">REPORTE GENERAL DE GRUPOS</h4>
        <h5 class="text-center">Información general</h5>
        <hr>
        <p>
            Grupos Chinandega: {{ $grupos->where('sucursal', 'CH')->count() }}
        </p>
        <p>
            Grupos Managua: {{ $grupos->where('sucursal', 'MG')->count() }}
        </p>
        <p>
            Total: {{ $grupos->count() }}
        </p>
    </div>
    <table class="table table-borderless table-striped align-middle" width="100%" cellspacing="0">
        <thead>
            <tr>
                <th>CURSO</th>
                <th>DOCENTE</th>
                <th>HORARIO</th>
                <th>AÑO</th>
                <th>SUCURSAL</th>
                <th>ALUMNOS</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($grupos as $grupo)
                <tr>
                    <td>{{ $grupo->curso_nombre }}</td>
                    <td>{{ $grupo->docente_nombre }}</td>
                    <td>{{ $grupo->horario }}</td>
                    <td>{{ $grupo->anyo }}</td>
                    <td>{{ $grupo->sucursal }}</td>
                    <td>{{ $grupo->inscripciones_count }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
