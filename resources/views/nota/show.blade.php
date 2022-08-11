@extends('reporte.layout')

@section('title', $grupo->curso_nombre)

@section('content')
    <div class="card-title">
        <h4 class="text-center">REPORTE DE NOTAS</h4>
        <h5 class="text-center">{{ $grupo->curso_nombre }}</h5>
        <hr>
        <table class="table my-3">
            <tr>
                <td>DOCENTE</td>
                <td class="fw-bolder">{{ $grupo->docente_nombre }}</td>
                <td>HORARIO</td>
                <td>{{ $grupo->horario }} </td>
            </tr>
            <tr>
                <td>SUCURSAL</td>
                <td>{{ $grupo->sucursal == 'CH' ? 'Chinandega' : 'Managua' }} </td>
                <td>FECHA</td>
                <td> {{ date('d-m-Y') }}</td>
            </tr>
        </table>
    </div>

    <table class="table table-bordered table-sm align-middle" width="100%" cellspacing="0">
        <tbody>
            <tr>
                <td>Carnet</td>
                <td>Nombre</td>
            </tr>
            @foreach ($inscripciones as $inscripcion)
                <tr>
                    <td>{{ $inscripcion->matricula_carnet }}</td>
                    <td>{{ $inscripcion->matricula_nombre }}</td>

                    @foreach ($inscripcion->notas as $nota)
                        <td>
                            <div class="small">{{ $nota->mod }}: {{ $nota->valor }}</div>
                        </td>
                    @endforeach
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
