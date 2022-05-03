@extends('layout')

@section('title', 'Notas')

@section('content')
    <div class="container-fluid">

        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('index') }}">Inicio</a></li>
                <li class="breadcrumb-item"><a href="{{ route('grupos.index') }}">Grupos</a></li>
                <li class="breadcrumb-item"><a href="{{ route('grupos.show', $grupo_id) }}">Alumnos</a></li>
                <li class="breadcrumb-item active" aria-current="page">Notas</li>
            </ol>
        </nav>

        <!-- Content Row -->
        <div class="row">
            <form class="col-xl-12 col-lg-7">

                <!-- Datos de los pagos -->
                <div class="card shadow mb-4">
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary">{{ $pivot->matricula->nombre }} - NOTAS</h6>
                        <div class="dropdown no-arrow">
                            <button type="button" class="btn btn-sm btn-primary ml-2" data-toggle="modal"
                                data-target="#agregar">
                                Agregar<i class="fas fa-plus ml-1"></i>
                            </button>
                        </div>
                    </div>

                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>Modulo</th>
                                        <th>Nota</th>
                                        <th>Fecha</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($pivot->notas as $nota)
                                        <tr>
                                            <td>{{ $nota->unidad }}</td>
                                            <td>{{ $nota->valor }}</td>
                                            <td>{{ $nota->created_at }}</td>
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

@section('agregarModal')
    @include('nota.modal')
@endsection

@section('re-open')
    @if ($errors->any())
        <script>
            $('#agregar').modal('show')
        </script>
    @endif
@endsection
