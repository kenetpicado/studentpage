@extends('layout')

@section('title', 'Cursos')

@section('content')
    <div class="container-fluid">

        {{-- Cabecera --}}
        <div class="d-sm-flex align-items-center justify-content-between m-2">
            <h1 class="h3 mb-0 text-gray-800">Cursos</h1>
            <button type="button" class="btn btn-sm btn-primary ml-2" data-toggle="modal" data-target="#cursoModalCreate">
                Agregar <i class="fas fa-plus ml-1"></i>
            </button>
        </div>

        <!-- Content Row -->
        <div class="row">
            <div class="col-xl-12 col-lg-7">

                <!-- Datos del alumno -->
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">TODOS LOS CURSOS</h6>
                    </div>

                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>Nombre del curso</th>
                                        <th>Estado</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($cursos as $curso)
                                        <tr>
                                            <td>{{ $curso->nombre }}</td>
                                            <td>
                                                @if ($curso->estado == '1')
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
                                                        <a href="{{ route('curso.edit', $curso) }}" class="dropdown-item">Editar</a>
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
    </div>
@endsection('content')

@section('agregarModal')
    @include('curso.modal')
@endsection

@section('re-open')
    @if ($errors->any())
        <script>
            $('#cursoModalCreate').modal('show')
        </script>
    @endif
@endsection
