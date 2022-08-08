@extends('layout')

@section('title', 'Inicio')

@section('content')
    <x-header-0>Informacion general</x-header-0>
    <div class="card-body">

        <div class="row">
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card shadow-sm h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs fw-bolder text-primary text-uppercase mb-1">
                                    <a href="{{ route('promotores.index') }}">Promotores</a>
                                </div>
                                <div class="h5 mb-0 fw-bolder">{{ $info['promotores_total'] }}</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-user fa-2x text-secondary text-opacity-25"></i>
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
                                    <a href="{{ route('docentes.index') }}">Docentes</a>
                                </div>
                                <div class="h5 mb-0 fw-bolder">{{ $info['docentes_total'] }}</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-user fa-2x text-secondary text-opacity-25"></i>
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
                                    <a href="{{ route('cursos.index') }}">Cursos</a>
                                </div>
                                <div class="h5 mb-0 fw-bolder">{{ $info['cursos_total'] }}</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-laptop-code fa-2x text-secondary text-opacity-25"></i>
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
                                    <a href="{{ route('grupos.index') }}">Grupos</a>
                                </div>
                                <div class="h5 mb-0 fw-bolder">{{ $info['grupos_total'] }}</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-comment fa-2x text-secondary text-opacity-25"></i>
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
                                    <a href="{{ route('matriculas.index') }}">Matriculas</a>
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
        </div>

        <div class="row">
            {{-- <div class="col-lg-6 mb-4">
                <div class="card mb-4">
                    <div class="card-header">
                        <h6 class="m-0 fw-bolder">Estadisticas</h6>
                    </div>
                    <div class="card-body">
                        <h4 class="small fw-bolder">Docentes activos<span class="float-end">{{ $info['docentes_activos'] }} % </span>
                        </h4>
                        <div class="progress mb-4">
                            <div class="progress-bar bg-primary" role="progressbar"
                                style="width: {{ $info['docentes_activos'] }}%" aria-valuenow="0" aria-valuemin="0"
                                aria-valuemax="100"></div>
                        </div>

                        <h4 class="small fw-bolder">Cursos activos<span class="float-end">{{ $info['cursos_activos'] }} % </span>
                        </h4>
                        <div class="progress mb-4">
                            <div class="progress-bar bg-primary" role="progressbar"
                                style="width: {{ $info['cursos_activos'] }}%" aria-valuenow="0" aria-valuemin="0"
                                aria-valuemax="100"></div>
                        </div>

                        <h4 class="small fw-bolder">Grupos activos<span class="float-end">{{ $info['grupos_activos'] }} % </span>
                        </h4>
                        <div class="progress mb-4">
                            <div class="progress-bar bg-primary" role="progressbar"
                                style="width: {{ $info['grupos_activos'] }}%" aria-valuenow="0" aria-valuemin="0"
                                aria-valuemax="100"></div>
                        </div>

                        <h4 class="small fw-bolder">Matriculas activas<span class="float-end">{{ $info['matriculas_activos'] }} % </span>
                        </h4>
                        <div class="progress mb-4">
                            <div class="progress-bar bg-primary" role="progressbar"
                                style="width: {{ $info['matriculas_activos'] }}%" aria-valuenow="0" aria-valuemin="0"
                                aria-valuemax="100"></div>
                        </div>
                    </div>
                </div>
            </div> --}}

            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card mb-4">
                    <div class="card-header">
                        <h6 class="m-0 fw-bolder">Totales</h6>
                    </div>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">Docentes activos
                            <strong class="float-end">{{ $info['docentes_activos'] }}</strong>
                        </li>
                        <li class="list-group-item">Cursos activos <strong
                                class="float-end">{{ $info['cursos_activos'] }}</strong></li>
                        <li class="list-group-item">Grupos activos <strong
                                class="float-end">{{ $info['grupos_activos'] }}</strong></li>
                        <li class="list-group-item">Matriculas activas <strong
                                class="float-end">{{ $info['matriculas_activos'] }}</strong></li>
                    </ul>
                </div>
            </div>

            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card mb-4">
                    <div class="card-header">
                        <h6 class="m-0 fw-bolder">Año {{ date('Y') }}</h6>
                    </div>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">Grupos totales <strong
                                class="float-end">{{ $info['grupos_anyo'] }}</strong></li>
                        <li class="list-group-item">Grupos activos <strong
                                class="float-end">{{ $info['grupos_anyo_activo'] }}</strong></li>
                        <li class="list-group-item">Matriculas totales <strong
                                class="float-end">{{ $info['matriculas_anyo'] }}</strong></li>
                        <li class="list-group-item">Matriculas activas <strong
                                class="float-end">{{ $info['matriculas_anyo_activo'] }}</strong></li>
                    </ul>
                </div>
            </div>
        </div>
    @endsection
