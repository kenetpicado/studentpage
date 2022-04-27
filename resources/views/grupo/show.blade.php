@extends('layout')

@section('title', 'Grupo')

@section('content')
    <div class="container-fluid">

        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('index') }}">Inicio</a></li>
                <li class="breadcrumb-item"><a href="{{ route('grupos.index') }}">Grupos</a></li>
                <li class="breadcrumb-item active" aria-current="page">Alumnos</li>
            </ol>
        </nav>

        <!-- Content Row -->
        <div class="row">
            <form class="col-xl-12 col-lg-7">

                <!-- Datos -->
                <div class="card shadow mb-4">
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary">{{$grupo->curso->nombre}} / {{$grupo->horario}} / {{$grupo->docente->nombre}}</h6>
                    </div>

                    <div class="card-body">

                        <div class="table-responsive">
                            <table class="table table-striped" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Carnet</th>
                                        <th>Nombre</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($grupo->matriculas as $matricula)
                                        <tr>
                                            <td>{{ $matricula->id }}</td>
                                            <td>{{ $matricula->carnet }}</td>
                                            <td>{{ $matricula->nombre }}</td>
                                            <td>
                                                <div class="dropdown no-arrow">
                                                    <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink"
                                                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                        <i class="fas fa-tasks"></i>
                                                    </a>
                                                    <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in"
                                                        aria-labelledby="dropdownMenuLink">
                                                        <a href="{{ route('notas.agregar', [$matricula->id, $grupo->id]) }}"
                                                            class="dropdown-item">Notas</a>
                                                        <a href="{{ route('pagos.pagar', [$matricula->id, $grupo->id]) }}"
                                                            class="dropdown-item">Pagos</a>
                                                        <a href="{{ route('grupos.seleccionar', [$matricula->id, $grupo->id]) }}"
                                                            class="dropdown-item">Cambiar de grupo</a>
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
