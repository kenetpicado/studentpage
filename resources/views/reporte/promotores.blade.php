@extends('reporte.layout')

@section('title', 'Promotores')

@section('content')
    <div class="card-title">
        <h4 class="text-center">REPORTE GENERAL DE PROMOTORES</h4>
        <h5 class="text-center">Información general de Matrículas registradas</h5>
        <hr>
        <p>
            Promotores registrados: {{ $promotores->count() }}
        </p>
        <p>
            Se cuentan únicamente las matrículas activas.
        </p>
    </div>
    <table class="table table-borderless table-striped" width="100%" cellspacing="0">
        <thead>
            <tr>
                <th>CARNET</th>
                <th>NOMBRE</th>
                <th>MATRICULAS</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($promotores as $promotor)
                <tr class="fw-bolder">
                    <td>{{ $promotor->carnet }}</td>
                    <td>{{ $promotor->nombre }}</td>
                    <td>{{ $promotor->matriculas->count() }}</td>
                </tr>
                <tr class="align-middle">
                    <td>Sucursales</td>
                    <td>
                        Matriculas Chinandega:
                        <br>
                        Matriculas Managua:
                    </td>
                    <td>
                        {{ $promotor->matriculas->where('sucursal', 'CH')->count() }}
                        <br>
                        {{ $promotor->matriculas->where('sucursal', 'MG')->count() }}
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
