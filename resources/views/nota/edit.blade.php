@extends('layout')

@section('title', 'Editar nota')

@section('content')
    <div class="container-fluid">

        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('index') }}">Inicio</a></li>
                <li class="breadcrumb-item"><a href="{{ route('grupos.index') }}">Grupos</a></li>
                <li class="breadcrumb-item"><a href="{{ route('grupos.show', $grupo_id) }}">Alumnos</a></li>
                <li class="breadcrumb-item"><a href="{{ route('notas.create', [$matricula_id, $grupo_id]) }}">Notas</a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">Editar</li>
            </ol>
        </nav>

        <!-- Content Row -->
        <div class="row">
            <div class="col-xl-12 col-lg-7">

                <!-- Datos-->
                <div class="card shadow mb-4">
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary">EDITAR NOTA</h6>
                    </div>

                    <div class="card-body">
                        <form action="{{ route('notas.update', $nota) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="row">
                                <div class="form-group col-lg-6">
                                    <label for="unidad">Materia</label>
                                    <input type="text" class="form-control @error('unidad') is-invalid @enderror"
                                        name="unidad" autocomplete="off" value="{{ old('unidad', $nota->unidad) }}"
                                        autofocus>

                                    @error('unidad')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            
                            <div class="row">
                                <div class="form-group col-lg-6">
                                    <label for="valor">Nota</label>
                                    <input type="text" class="form-control @error('valor') is-invalid @enderror"
                                        name="valor" autocomplete="off" value="{{ old('valor', $nota->valor) }}"
                                        autofocus>

                                    @error('valor')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <input type="hidden" name="matricula_id" value="{{ $matricula_id }}">
                            <input type="hidden" name="grupo_id" value="{{ $grupo_id }}">
                            <button type="submit" class="btn btn-primary">Guardar</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- Content Row -->
    </div>
@endsection('content')
