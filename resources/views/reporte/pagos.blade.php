@extends('reporte.layout')

@section('title', 'Pagos')

@section('content')
    <div class="card-title">
        <h4 class="text-center">REPORTE GENERAL PAGOS</h4>
        <h5 class="text-center">Información general de pagos</h5>
        <hr>
        <table class="table my-3">
            <tr>
                <td>CURSO</td>
                <td class="fw-bolder">{{ $grupo->curso_nombre }}</td>
            </tr>
            <tr>
                <td>DOCENTE</td>
                <td>{{ $grupo->docente_nombre }}</td>
            </tr>
            <tr>
                <td>HORARIO</td>
                <td>{{ $grupo->horario }}</td>
            </tr>
            <tr>
                <td>AÑO</td>
                <td>{{ $grupo->anyo }}</td>
            </tr>
            <tr>
                <td>SUCURSAL</td>
                <td> {{ $grupo->sucursal == 'CH' ? 'Chinandega' : 'Managua' }}</td>
            </tr>
        </table>
        <p>
            Todos los alumnos: {{ $matriculas->count() }}
        </p>
    </div>

    <table class="table table-borderless table-striped" width="100%" cellspacing="0">
        <thead>
            <tr>
                <th>CARNET</th>
                <th>NOMBRE</th>
                <th>Ultimo pago</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($matriculas as $matricula)
                <tr>
                    <td>{{ $matricula->carnet }}</td>
                    <td>{{ $matricula->nombre }}</td>
                    <td>{{ $matricula->pagos->first()->created_at ?? ''}} - {{ $matricula->pagos->first()->concepto ?? '' }} </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
