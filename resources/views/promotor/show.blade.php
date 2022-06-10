@extends('layout')

@section('title', 'Matriculas promotor')

@section('content')
    <div class="container-fluid">

        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('index') }}">Inicio</a></li>
                <li class="breadcrumb-item"><a href="{{ route('promotores.index') }}">Promotores</a></li>
                <li class="breadcrumb-item active" aria-current="page">Matrículas</li>
            </ol>
        </nav>

        <!-- Content Row -->
        <div class="row">
            <form class="col-xl-12 col-lg-7">

                <!-- Datos -->
                <div class="card shadow mb-4">
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary">{{ $promotor->nombre }} - Matrículas</h6>
                    </div>

                    <div class="card-body ">
                        <div class="table-responsive">
                            <table class="table table-borderless" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>Carnet</th>
                                        <th>Nombre</th>
                                        <th>Fecha registro</th>
                                        <th>Estado</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($matriculas as $matricula)
                                        <tr>
                                            <td>{{ $matricula->carnet }}</td>
                                            <td>{{ $matricula->nombre }}</td>
                                            <td>{{ $matricula->created_at }}</td>
                                            <td>
                                                @if (count($matricula->inscripciones) > 0)
                                                    Inscrito <i class="fas fa-check-circle" style="color:limegreen"></i>
                                                @else
                                                    Pendiente <i class="fas fa-exclamation-circle" style="color:tomato"></i>
                                                @endif
                                            </td>
                                            <td>
                                                <a class="btn btn-primary btn-sm"
                                                    href="{{ route('inscripciones.create', [$matricula->id, $matricula->promotor_id]) }}">Inscribir
                                                </a>
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
