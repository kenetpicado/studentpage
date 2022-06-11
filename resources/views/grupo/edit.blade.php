@extends('layout')

@section('title', 'Editar grupo')

@section('content')
    <div class="container-fluid">

        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('index') }}">Inicio</a></li>
                <li class="breadcrumb-item"><a href="{{ route('grupos.index') }}">Grupos</a></li>
                <li class="breadcrumb-item active" aria-current="page">Editar</li>
            </ol>
        </nav>

        <!-- Content Row -->
        <div class="row">
            <form class="col-12" action="{{ route('grupos.update', $grupo) }}" method="POST">
                @csrf
                @method('PUT')
                <!-- Datos del alumno -->
                <div class="card shadow mb-4">
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary">Editar grupo</h6>
                        <div class="dropdown no-arrow">
                            <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown"
                                aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in"
                                aria-labelledby="dropdownMenuLink">
                                <a class="dropdown-item" href="#" data-toggle="modal"
                                        data-target="#cerrar">Cerrar grupo</a>

                                @if (count($grupo->inscripciones) == 0)
                                    <a class="dropdown-item" href="#" data-toggle="modal"
                                        data-target="#eliminar">Eliminar</a>
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="card-body">
                        
                        <div class="row">
                            <div class="form-group col-lg-6">
                                <label for="docente_id">Seleccionar docente</label>
                                <select name="docente_id" class="form-control @error('docente_id') is-invalid @enderror" autofocus>
                                    <option selected disabled value="">Seleccionar</option>
                                    @foreach ($docentes as $docente)
                                        <option value="{{ $docente->id }}"
                                            {{ old('docente_id') == $docente->id || $grupo->docente_id == $docente->id ? 'selected' : '' }}>
                                            {{ $docente->nombre }}</option>
                                    @endforeach
                                </select>
                                @error('docente_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-lg-6">
                                <label for="horario">Horario</label>
                                <input type="text" class="form-control @error('horario') is-invalid @enderror"
                                    name="horario" autocomplete="off" value="{{ old('horario', $grupo->horario) }}">
                                @error('horario')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary">Actualizar</button>
                    </div>
                </div>
            </form>
        </div>
        <!-- Content Row -->

        <!-- Elimiar-->
        <div class="modal fade" id="eliminar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Eliminar</h5>
                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <form action="{{ route('grupos.destroy', $grupo->id ?? '') }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <div class="modal-body">
                            <p>
                                ¿Está seguro que desea eliminar este registro? 
                                Esta acción no se puede deshacer.
                            </p>
                        </div>
                        <div class="modal-footer">
                            <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancelar</button>
                            <button type="submit" class="btn btn-danger">Eliminar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Cerrar-->
        <div class="modal fade" id="cerrar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Cerrar grupo</h5>
                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <form action="{{ route('grupos.status', $grupo->id) }}" method="GET">
                        @csrf
                        {{-- @method('PUT') --}}
                        <div class="modal-body">
                            Esta opción establece el grupo como "terminado", de modo que solo debería ejecutarse cuando
                            el grupo haya culminado su plan de estudio y no existan más operaciones a realizar.
                        </div>
                        <div class="modal-footer">
                            <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancelar</button>
                            <button type="submit" class="btn btn-primary">Cerrar grupo</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </div>
@endsection('content')
