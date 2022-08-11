@extends('reporte.layout')

@section('title', 'Docente')

@section('content')
    <div class="card-title">
        <h4 class="text-center">REPORTE GENERAL DOCENTE</h4>
        <h5 class="text-center">Información general de Grupos asignados</h5>
        <hr>
        <table class="table my-3">
            <tr>
                <td>NOMBRE</td>
                <td class="fw-bolder">{{ $docente->nombre }}</td>
            </tr>
            <tr>
                <td>CARNET</td>
                <td>{{ $docente->carnet }}</td>
            </tr>
            <tr>
                <td>CORREO</td>
                <td>{{ $docente->correo }}</td>
            </tr>
            <tr>
                <td>SUCURSAL</td>
                <td> {{ $docente->sucursal == 'CH' ? 'Chinandega' : 'Managua' }}</td>
            </tr>
            <tr>
                <td>ESTADO</td>
                <td> {{ $docente->activo == '1' ? 'Activo' : '-' }}</td>
            </tr>
        </table>
        <p>
            Grupos asignados: {{ $grupos->count() }}
        </p>
        <p>
            Se cuentan únicamente los grupos activos.
        </p>
    </div>

    <table class="table table-borderless" width="100%" cellspacing="0">
        <thead>
            <tr>
                <th>CURSO</th>
                <th>HORARIO</th>
                <th>AÑO</th>
                <th>ALUMNOS</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($grupos as $grupo)
                <tr>
                    <td>{{ $grupo->curso }}</td>
                    <td>{{ $grupo->horario }}</td>
                    <td>{{ $grupo->anyo }}</td>
                    <td>{{ $grupo->inscripciones_count }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
