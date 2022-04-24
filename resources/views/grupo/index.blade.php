@extends('layout')

@section('title', 'Grupos')

@section('content')
    <div class="container-fluid">

        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('home')}}">Inicio</a></li>
                <li class="breadcrumb-item active" aria-current="page">Grupos</li>
            </ol>
        </nav>

        <!-- Content Row -->
        <div class="row">
            <div class="col-xl-12 col-lg-7">

                <!-- Datos -->
                <div class="card shadow mb-4">
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary">GRUPOS</h6>
                        <div class="dropdown no-arrow">
                            <a href="{{route('grupo.create')}}" class="btn btn-sm btn-primary ml-2">
                                Agregar <i class="fas fa-plus ml-1"></i>
                            </a>
                        </div>
                    </div>

                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Curso</th>
                                        <th>Docente</th>
                                        <th>Horario</th>
                                        <th>Sucursal</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($grupos as $grupo)
                                        <tr>
                                            <td>{{ $grupo->id }}</td>
                                            <td>{{ $grupo->curso->nombre }}</td> 
                                            <td>{{ $grupo->docente->nombre }}</td>
                                            <td>{{ $grupo->horario }}</td>
                                            <td>{{ $grupo->sucursal }} - {{ $grupo->anyo }}</td>
                                            <td>
                                                <div class="dropdown no-arrow">
                                                    <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink"
                                                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                        <i class="fas fa-tasks"></i>
                                                    </a>
                                                    <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in"
                                                        aria-labelledby="dropdownMenuLink">
                                                        <a href="{{ route('grupo.show', $grupo->id) }}"
                                                            class="dropdown-item">Alumnos</a>
                                                        <a href="{{ route('grupo.edit', $grupo) }}"
                                                            class="dropdown-item">Editar</a>
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
            </div>
        </div>
        <!-- Content Row -->
    </div>
@endsection('content')
