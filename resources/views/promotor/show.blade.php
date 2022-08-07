@extends('layout')

@section('title', 'Matriculas promotor')

@section('bread')
    <li class="breadcrumb-item"><a href="{{ route('promotores.index') }}">Promotores</a></li>
    <li class="breadcrumb-item active" aria-current="page">Matrículas</li>
@endsection

@section('card')
    <div class="row">
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card shadow-sm h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs fw-bolder text-primary text-uppercase mb-1">
                                <a href="{{ route('matriculas.index') }}">totales</a>
                            </div>
                            <div class="h5 mb-0 fw-bolder">{{ $info['matriculas_total'] }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-users fa-2x text-secondary text-opacity-25"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card shadow-sm h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs fw-bolder text-primary text-uppercase mb-1">
                                <a href="{{ route('matriculas.index') }}">activas</a>
                            </div>
                            <div class="h5 mb-0 fw-bolder">{{ $info['matriculas_activas'] }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-users fa-2x text-secondary text-opacity-25"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card shadow-sm h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs fw-bolder text-primary text-uppercase mb-1">
                                <a href="{{ route('matriculas.index') }}">totales {{ date('Y') }}</a>
                            </div>
                            <div class="h5 mb-0 fw-bolder">{{ $info['matriculas_anyo'] }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-users fa-2x text-secondary text-opacity-25"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card shadow-sm h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs fw-bolder text-primary text-uppercase mb-1">
                                <a href="{{ route('matriculas.index') }}">activas {{ date('Y') }}</a>
                            </div>
                            <div class="h5 mb-0 fw-bolder">{{ $info['matriculas_anyo_activas'] }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-users fa-2x text-secondary text-opacity-25"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('content')
    <x-header-0>Matrículas</x-header-0>

    <x-table-head>
        <x-slot name="title">
            <th>Carnet</th>
            <th>Nombre</th>
            <th>Fecha registro</th>
            <th>Estado</th>
            <th>Inscribir</th>
            <th>Ver detalles</th>
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
                        <a class="btn btn-primary btn-sm"
                            href="{{ route('inscripciones.create', [$matricula->id, $matricula->promotor_id]) }}">Inscribir
                        </a>
                    </td>
                    <td>
                        <a class="btn btn-outline-primary btn-sm" href="{{ route('matriculas.show', $matricula->id) }}"
                            target="_blank">Detalles</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </x-table-head>
@endsection
