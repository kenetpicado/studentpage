@extends('layout')

@section('title', 'Matriculas')

@section('content')
    <div class="container-fluid">

        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('index') }}">Inicio</a></li>
                <li class="breadcrumb-item active" aria-current="page">Matriculas</li>
            </ol>
        </nav>

        @include('matricula.modal')

        <!-- Content Row -->
        <div class="row">
            <form class="col-xl-12 col-lg-7">

                <!-- Datos -->
                <div class="card shadow mb-4">
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary">Matriculas</h6>
                        <div class="dropdown no-arrow">
                            <button type="button" class="btn btn-sm btn-primary ml-2" data-toggle="modal"
                                data-target="#agregar">
                                Agregar<i class="fas fa-plus ml-1"></i>
                            </button>
                        </div>
                    </div>

                    <div class="card-body ">
                        <div class="table-responsive">
                            <table class="table table-borderless" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Carnet</th>
                                        <th>Nombre</th>
                                        <th>Promotor</th>
                                        <th>Fecha registro</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($matriculas as $matricula)
                                        <tr>
                                            <td>{{ $matricula->id }}</td>
                                            <td>
                                                @if ($matricula->activo == '1')
                                                    <i class="fas fa-circle fa-xs" style="color:limegreen"></i>
                                                @else
                                                    <i class="fas fa-circle fa-xs"></i>
                                                @endif
                                                {{ $matricula->carnet }}
                                            </td>
                                            <td>{{ $matricula->nombre }}</td>
                                            <td>{{ $matricula->promotor->carnet ?? '' }}</td>
                                            <td>{{ $matricula->created_at }}</td>
                                            <td>
                                                <div class="dropdown no-arrow">
                                                    <a class="dropdown-toggle btn btn-primary btn-sm" href="#" role="button"
                                                        id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true"
                                                        aria-expanded="false">
                                                        <i class="fas fa-cog"></i>
                                                    </a>
                                                    <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in"
                                                        aria-labelledby="dropdownMenuLink">
                                                        {{-- Solo el administrador puede inscribir --}}
                                                        @if (auth()->user()->rol == 'admin')
                                                            <a class="dropdown-item"
                                                                href="{{ route('inscripciones.create', [$matricula->id, 'global']) }}">Inscribir
                                                                a curso</a>

                                                            <a class="dropdown-item"
                                                                href="{{ route('matriculas.show', $matricula) }}"
                                                                target="_blank">Ver
                                                                detalles</a>
                                                        @endif

                                                        <a class="dropdown-item"
                                                            href="{{ route('matriculas.edit', $matricula) }}">Editar</a>

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

@section('re-open')
    @if ($errors->any())
        <script>
            $('#agregar').modal('show')
        </script>
    @endif
@endsection
