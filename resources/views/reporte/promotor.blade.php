@extends('reporte.layout')

@section('title', 'Promotor')

@section('content')
    <div class="card-title">
        <h4 class="text-center">REPORTE GENERAL PROMOTOR</h4>
        <table class="table my-3">
            <tr>
                <td>NOMBRE </td>
                <td class="fw-bolder">{{ $promotor->nombre }}</td>
            </tr>
            <tr>
                <td>CARNET</td>
                <td>{{ $promotor->carnet }}</td>
            </tr>
            <tr>
                <td>CORREO</td>
                <td>{{ $promotor->correo }}</td>
            </tr>
        </table>

    </div>
    <div class="row my-3">

        <div class="col">
            <div class="card">
                <div class="card-header">
                    <h6 class="m-0 fw-bolder">MATRICULAS TOTAL</h6>
                </div>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item">Chinandega
                        <strong class="float-end">{{ $info['matriculas_ch_total'] }}</strong>
                    </li>
                    <li class="list-group-item">Managua<strong class="float-end">{{ $info['matriculas_mg_total'] }}</strong>
                    </li>
                    <li class="list-group-item">Total<strong class="float-end">{{ $info['matriculas_total'] }}</strong>
                    </li>
                </ul>
            </div>
        </div>

        <div class="col">
            <div class="card">
                <div class="card-header">
                    <h6 class="m-0 fw-bolder">MATRICULAS ACTIVAS</h6>
                </div>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item">Chinandega
                        <strong class="float-end">{{ $info['matriculas_ch'] }}</strong>
                    </li>
                    <li class="list-group-item">Managua<strong class="float-end">{{ $info['matriculas_mg'] }}</strong></li>
                    <li class="list-group-item">Total<strong class="float-end">{{ $info['matriculas'] }}</strong>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <table class="table table-borderless" width="100%" cellspacing="0">
        <thead>
            <tr>
                <th>CARNET</th>
                <th>NOMBRE</th>
                <th>FECHA REGISTRO</th>
                <th>ESTADO</th>
                <th>INSCRITO</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($matriculas as $matricula)
                <tr>
                    <td>{{ $matricula->carnet }}</td>
                    <td>{{ $matricula->nombre }}</td>
                    <td>{{ $matricula->created_at }}</td>
                    <td>
                        {{ $matricula->activo == '1' ? 'Activo' : '-'}}
                    </td>
                    <td>
                        {{ $matricula->inscripciones_count > '0' ? 'Inscrito' : '-'}}
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
