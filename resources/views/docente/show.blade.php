@extends('layout')

@section('title', 'Docente')

@section('content')
    <div class="container-fluid">

        <!-- Content Row -->
        <div class="row">
            <form class="col-xl-12 col-lg-7">

                <!-- Datos -->
                <div class="card shadow mb-4">
                    <!-- Card Header - Dropdown -->
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary">{{ $docente->nombre }} - GRUPOS</h6>
                    </div>

                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>Curso</th>
                                        <th>Grupo</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($docente->grupos as $grupo)
                                        <tr>
                                            <td>{{ $grupo->curso->nombre }}</td>
                                            <td>{{ $grupo->numero }}</td>
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
