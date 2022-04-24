@extends('layout')

@section('title', 'Docentes')

@section('content')
    <div class="container-fluid">

        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('home')}}">Inicio</a></li>
                <li class="breadcrumb-item active" aria-current="page">Docentes</li>
            </ol>
        </nav>

        <!-- Content Row -->
        <div class="row">
            <div class="col-xl-12 col-lg-7">

                <!-- Datos -->
                <div class="card shadow mb-4">
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary">DOCENTES</h6>
                        <div class="dropdown no-arrow">
                            <button type="button" class="btn btn-sm btn-primary ml-2" data-toggle="modal" data-target="#agregar">
                                Agregar<i class="fas fa-plus ml-1"></i>
                            </button>
                        </div>
                    </div>

                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>ID</th>
                                        <th>Nombre</th>
                                        <th>Correo</th>
                                        <th>Estado</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($docentes as $docente)
                                        <tr>
                                            <td>{{ $docente->id }}</td>
                                            <td>{{ $docente->carnet }}</td>
                                            <td>{{ $docente->nombre }}</td>
                                            <td>{{ $docente->correo }}</td>
                                            <td>
                                                @if ($docente->estado == '1')
                                                    <span class="badge badge-pill badge-success">Activo</span>
                                                @else
                                                    <span class="badge badge-pill badge-danger">Inactivo</span>
                                                @endif
                                            </td>
                                            <td>
                                                <div class="dropdown no-arrow">
                                                    <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink"
                                                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                        <i class="fas fa-tasks"></i>
                                                    </a>
                                                    <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in"
                                                        aria-labelledby="dropdownMenuLink">

                                                        <a href="{{ route('docente.show', $docente->id) }}" class="dropdown-item">Ver grupos</a>
                                                        <a href="{{ route('docente.edit', $docente->id) }}" class="dropdown-item">Editar</a>
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

@section('agregarModal')
    @include('docente.modal')
@endsection

@section('re-open')
    @if ($errors->any())
        <script>
            $('#agregar').modal('show')
        </script>
    @endif
@endsection
