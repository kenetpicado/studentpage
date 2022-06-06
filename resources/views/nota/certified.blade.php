@extends('layout')

@section('title', 'Notas')

@section('content')
    <div class="container-fluid">

        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('index') }}">Inicio</a></li>
                <li class="breadcrumb-item"><a href="{{ route('grupos.index') }}">Grupos</a></li>
                <li class="breadcrumb-item"><a href="{{ route('grupos.closed') }}">Terminados</a></li>
                <li class="breadcrumb-item"><a href="{{ route('grupos.thisClosed', $grupo_id) }}">Alumnos</a></li>
                <li class="breadcrumb-item active" aria-current="page">Certificado</li>
            </ol>
        </nav>

        <!-- Content Row -->
        <div class="row">
            <form class="col-xl-12 col-lg-7">

                <!-- Datos de los pagos -->
                <div class="card shadow mb-4">
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary">Certificado de notas</h6>
                    </div>

                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-borderless" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Materia</th>
                                        <th>Nota</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($notas as $nota)
                                        <tr>
                                            <td>{{ $nota->num }}</td>
                                            <td>{{ $nota->materia }}</td>
                                            <td>{{ $nota->valor }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection('content')