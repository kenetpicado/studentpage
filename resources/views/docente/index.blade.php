@extends('layout')

@section('title', 'Docentes')

@section('content')
    <div class="container-fluid">

        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('index') }}">Inicio</a></li>
                <li class="breadcrumb-item active" aria-current="page">Docentes</li>
            </ol>
        </nav>

        <!-- Content Row -->
        <div class="row">
            <div class="col-xl-12 col-lg-7">

                <!-- Datos -->
                <div class="card mb-4">
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary">Docentes</h6>
                        <div class="dropdown no-arrow">
                            <button type="button" class="btn btn-sm btn-primary ml-2" data-toggle="modal"
                                data-target="#agregar">
                                Agregar<i class="fas fa-plus ml-1"></i>
                            </button>
                        </div>
                    </div>

                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-borderless" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Nombre</th>
                                        <th>Correo</th>
                                        <th>Estado</th>
                                        <th>Grupos</th>
                                        <th>Editar</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($docentes as $docente)
                                        <tr>
                                            <td>
                                                {{ $docente->carnet }}
                                            </td>
                                            <td>{{ $docente->nombre }}</td>
                                            <td>{{ $docente->correo }}</td>
                                            <td>
                                                @if ($docente->activo == '1')
                                                    Activo <i class="fas fa-check-circle" style="color:limegreen"></i>
                                                @endif
                                            </td>
                                            <td>
                                                <a href="{{ route('docentes.show', $docente->id) }}"
                                                    class="btn btn-primary btn-sm">Grupos</a>
                                            </td>
                                            <td>
                                                <a href="{{ route('docentes.edit', $docente->id) }}"
                                                    class="btn btn-outline-primary btn-sm">Editar</a>
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
