@extends('layout')

@section('title', 'Matriculas promotor')

@section('bread')
    <li class="breadcrumb-item"><a href="{{ route('promotores.index') }}">Promotores</a></li>
    <li class="breadcrumb-item active" aria-current="page">Matrículas</li>
@endsection

@section('card')
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
        <div class="col">
            <div class="card">
                <div class="card-header">
                    <h6 class="m-0 fw-bolder">MATRICULAS {{ date('Y') }}</h6>
                </div>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item">Activas<strong
                            class="float-end">{{ $info['matriculas_anyo_activas'] }}</strong></li>
                    <li class="list-group-item">Total
                        <strong class="float-end">{{ $info['matriculas_anyo'] }}</strong>
                    </li>
                </ul>
            </div>
        </div>
    </div>
@endsection

@section('content')
    <x-header-2 text="Matriculas">
        <a class="dropdown-item" href="{{ route('reportes.promotor', $promotor_id) }}" target="_blank">Generar reporte</a>
    </x-header-2>

    <x-table-head>
        <x-slot name="title">
            <th>Carnet</th>
            <th>Nombre</th>
            <th>Fecha registro</th>
            <th>Estado</th>
            <th>Opciones</th>
        </x-slot>
        <tbody>
            @foreach ($matriculas as $matricula)
                <tr>
                    <td>{{ $matricula->carnet }}</td>
                    <td>{{ $matricula->nombre }}</td>
                    <td>{{ $matricula->created_at }}</td>
                    <td>
                        @if ($matricula->inscripciones_count > 0)
                            <i class="fas fa-check-circle text-primary"></i> Inscrito
                        @else
                            <i class="fas fa-exclamation-circle text-danger"></i> Pendiente
                        @endif
                    </td>
                    <td>
                        <div class="dropdown">
                            <button class="btn btn-primary dropdown-toggle btn-sm" type="button" id="dropdownMenuButton1"
                                data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="fas fa-cog"></i>
                            </button>
                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                <a class="dropdown-item"
                                    href="{{ route('inscripciones.create', [$matricula->id, $matricula->promotor_id]) }}">Inscribir
                                </a>
                                <a class="dropdown-item" href="{{ route('matriculas.show', $matricula->id) }}"
                                    target="_blank">Detalles</a>
                                <a class="dropdown-item" href="{{ route('matriculas.edit', $matricula->id) }}">Editar</a>
                            </ul>
                        </div>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </x-table-head>
@endsection
