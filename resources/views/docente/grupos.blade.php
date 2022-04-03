@extends('layout')

@section('title', 'Grupos')

@section('content')
    <div class="container-fluid">

        <!-- Cabecera -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Grupos del docente: {{$docente->nombre}}</h1>
        </div>

        <!-- Content Row -->
        <div class="row">
            <form class="col-xl-12 col-lg-7">

                <!-- Datos -->
                <div class="card shadow mb-4">
                    <!-- Card Header - Dropdown -->
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary">VER GRUPOS</h6>
                    </div>

                    <div class="card-body">
                        <div class="alert alert-primary" role="alert">{{$status ?? ''}}</div>
                        <div class="table-responsive">
                            <table class="table table-striped" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Curso</th>
                                        <th>Grupo</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($docente->grupos as $grupo)
                                        <tr>
                                            <td>{{ $grupo->id }}</td>
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
