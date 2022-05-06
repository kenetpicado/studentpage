@extends('layout')

@section('title', 'Cursos')

@section('content')
    <div class="container-fluid">

        <!-- Content Row -->
        <div class="row">
            <form class="col-xl-12 col-lg-7">

                <!-- Datos -->
                <div class="card shadow mb-4">
                    <!-- Card Header - Dropdown -->
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary">{{ $curso->nombre }} - GRUPOS</h6>
                    </div>

                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>Docente</th>
                                        <th>Horario</th>
                                        <th>Sucursal</th>
                                        <th>Año</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($curso->grupos as $grupo)
                                        <tr>
                                            <td>{{ $grupo->docente->nombre }}</td>
                                            <td>{{ $grupo->horario }}</td>
                                            <td>{{ $grupo->sucursal }}</td>
                                            <td>{{ $grupo->anyo }}</td>
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
