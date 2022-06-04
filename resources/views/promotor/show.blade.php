@extends('layout')

@section('title', 'Matriculas promotor')

@section('content')
    <div class="container-fluid">

        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('index') }}">Inicio</a></li>
                <li class="breadcrumb-item"><a href="{{ route('promotores.index') }}">Promotores</a></li>
                <li class="breadcrumb-item active" aria-current="page">Matriculas</li>
            </ol>
        </nav>

        <!-- Content Row -->
        <div class="row">
            <form class="col-xl-12 col-lg-7">

                <!-- Datos -->
                <div class="card shadow mb-4">
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary">Matriculas</h6>
                    </div>

                    <div class="card-body ">
                        <div class="table-responsive">
                            <table class="table table-striped" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Carnet</th>
                                        <th>Nombre</th>
                                        <th>Fecha registro</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($matriculas as $key => $matricula)
                                        <tr>
                                            <td>{{ $key + 1 }}</td>
                                            <td>{{ $matricula->carnet }}</td>
                                            <td>{{ $matricula->nombre }}</td>
                                            <td>{{ $matricula->created_at }}</td>
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
