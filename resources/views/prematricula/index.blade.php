@extends('layout')

@section('title', 'Ver prematriculas')

@section('content')
    <div class="container-fluid">

        <!-- Content Row -->
        <div class="row">
            <form class="col-xl-12 col-lg-7">
                <div class="card shadow mb-4">

                    <!-- Card Header - Dropdown -->
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary">VER PREMATRICULAS</h6>
                        <div class="dropdown no-arrow">
                            <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown"
                                aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in"
                                aria-labelledby="dropdownMenuLink">
                                <div class="dropdown-header">Mostar:</div>
                                <a class="dropdown-item" href="{{ route('prematricula.activa') }}">Prematriculas
                                    activas</a>
                                <a class="dropdown-item" href="{{ route('prematricula.inactiva') }}">Prematriculas
                                    inactivas</a>
                                <a class="dropdown-item" href="{{ route('prematricula.index') }}">Todas</a>
                                {{-- <div class="dropdown-divider"></div> --}}
                            </div>
                        </div>
                    </div>

                    <div class="card-body">
                        <div class="alert alert-primary" role="alert">{{$status ?? ''}}</div>
                        <div class="table-responsive">
                            <table class="table table-striped" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Nombre</th>
                                        <th>Fecha de nacimiento</th>
                                        <th>Teléfono</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($prematriculas as $prematricula)
                                        <tr>
                                            <td>{{ $prematricula->id }}</td>
                                            <td>{{ $prematricula->nombre }}</td>
                                            <td>{{ $prematricula->fecha_nac }}</td>
                                            <td>{{ $prematricula->tel }}</td>
                                            <th>
                                                <div class="dropdown no-arrow">
                                                    <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink"
                                                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                        {{-- <i class="fas fa-exclamation-circle fa-sm fa-fw text-gray-400"></i> --}}
                                                        Ver opciones <i class="fas fa-cog"></i>
                                                    </a>
                                                    <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in"
                                                        aria-labelledby="dropdownMenuLink">
                                                        <a class="dropdown-item"
                                                            href="{{ route('prematricula.edit', $prematricula) }}">Editar</a>
                                                    </div>
                                                </div>
                                            </th>
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
