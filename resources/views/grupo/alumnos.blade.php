@extends('layout')

@section('title', 'Ver alumnos')

@section('content')
    <div class="container-fluid">

        <!-- Cabecera -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">"{{$grupo->curso->nombre}}" - {{$grupo->numero}}</h1>
        </div>

        <!-- Content Row -->
        <div class="row">
            <form class="col-xl-12 col-lg-7">

                <!-- Datos -->
                <div class="card shadow mb-4">
                    <!-- Card Header - Dropdown -->
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary">VER ALUMNOS</h6>
                        <div class="dropdown no-arrow">
                            <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown"
                                aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in"
                                aria-labelledby="dropdownMenuLink">
                                <a class="dropdown-item" href="{{ route('grupo.create') }}">Crear grupo</a>
                                
                            </div>
                        </div>
                    </div>

                    <div class="card-body">
                        <div class="alert alert-primary" role="alert">
                            {{$status ?? ''}}
                            Mostrando todos los alumnos del grupo {{$grupo->numero}} del curso {{$grupo->curso->nombre}}
                        </div>
                        <div class="table-responsive">
                            <table class="table table-striped" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Nombre</th>
                                        <th>Carnet</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($grupo->matriculas as $matricula)
                                        <tr>
                                            <td>{{ $matricula->id }}</td>
                                            <td>{{ $matricula->nombre}}</td>
                                            <td>{{ $matricula->carnet}}</td>
                                            <td>
                                                <div class="dropdown no-arrow">
                                                    <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink"
                                                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                        {{-- <i class="fas fa-exclamation-circle fa-sm fa-fw text-gray-400"></i> --}}
                                                        Ver opciones <i class="fas fa-cog"></i>
                                                    </a>
                                                    <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in"
                                                        aria-labelledby="dropdownMenuLink">

                                                        <a class="dropdown-item" href="{{ route('pago.estudiante', $matricula) }}">Ver pagos</a>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </form>
        </div>
        <!-- Content Row -->
    </div>
@endsection('content')
