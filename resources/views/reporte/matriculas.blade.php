@extends('reporte.layout')

@section('title', 'Matriculas')

@section('content')
    <div class="card-title">
        <h4 class="text-center">REPORTE GENERAL MATRICULAS</h4>
        <h5 class="text-center">Información general de Matrículas registradas</h5>
        <hr>
        <p>
            Desde: {{ $request->inicio }}
        </p>
        <p>
            Hasta: {{ $request->fin }}
        </p>
        <p>
            Todas las matriculas: {{ $matriculas->count() }}
        </p>
        <p>
            Se cuentan únicamente las matrículas activas.
        </p>
    </div>

    <table class="table table-borderless" width="100%" cellspacing="0">
        <thead>
            <tr>
                <th>CARNET</th>
                <th>NOMBRE</th>
                <th>FECHA REGISTRO</th>
                <th>Sucursal</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($matriculas as $matricula)
                <tr>
                    <td>{{ $matricula->carnet }}</td>
                    <td>{{ $matricula->nombre }}</td>
                    <td>{{ $matricula->created_at }}</td>
                    <td>{{ $matricula->sucursal == 'CH' ? 'Chinandega' : 'Managua' }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
