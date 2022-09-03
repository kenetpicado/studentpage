@extends('reporte.layout')

@section('title', $grupo->curso_nombre)

@section('content')
    <div class="card-title">
        <h4 class="text-center">REPORTE DE NOTAS</h4>
        <h5 class="text-center">{{ $grupo->curso_nombre }}</h5>
        <hr>
        <table class="table my-3">
            <tr>
                <td class="fw-bolder">DOCENTE</td>
                <td>{{ $grupo->docente_nombre }}</td>
                <td class="fw-bolder">HORARIO</td>
                <td>{{ $grupo->horario }} </td>
            </tr>
            <tr>
                <td class="fw-bolder">SUCURSAL</td>
                <td>{{ $grupo->sucursal == 'CH' ? 'Chinandega' : 'Managua' }} </td>
                <td class="fw-bolder">FECHA</td>
                <td> {{ date('d-m-Y') }}</td>
            </tr>
        </table>
    </div>

    <table class="table table-bordered table-sm align-middle" width="100%" cellspacing="0">
        
        <tbody>
            <tr>
                <th>Carnet</th>
                <th>Nombre</th>
                @foreach ($inscripciones->first()->notas as $nota)
                    <th class="small">{{ $nota->mod }}</th>
                @endforeach
            </tr>
            @foreach ($inscripciones as $inscripcion)
                <tr>
                    <td class="small">{{ $inscripcion->matricula_carnet }}</td>
                    <td>{{ $inscripcion->matricula_nombre }}</td>

                    @foreach ($inscripcion->notas as $nota)
                        <td>
                            <div>{{ $nota->valor }}</div>
                        </td>
                    @endforeach
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
