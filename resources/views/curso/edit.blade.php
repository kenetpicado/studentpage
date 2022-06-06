@extends('layout')

@section('title', 'Editar curso')

@section('content')
    <div class="container-fluid">

        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('index') }}">Inicio</a></li>
                <li class="breadcrumb-item"><a href="{{ route('cursos.index') }}">Cursos</a></li>
                <li class="breadcrumb-item active" aria-current="page">Editar</li>
            </ol>
        </nav>

        <!-- Content Row -->
        <div class="row">
            <div class="col-xl-12 col-lg-7">

                <!-- Datos-->
                <div class="card shadow mb-4">
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary">Editar</h6>
                        @if ($curso->grupos_count == 0)
                            <a class="btn btn-sm btn-primary" href="#" data-toggle="modal" data-target="#eliminar">
                                <i class="fas fa-trash"></i>
                            </a>
                        @endif
                    </div>

                    <div class="card-body">
                        <form action="{{ route('cursos.update', $curso) }}" method="POST">
                            @csrf
                            @method('PUT')

                            <div class="row">
                                <div class="form-group col-lg-6">
                                    <label for="nombre">Nombre del curso</label>
                                    <input type="text" class="form-control @error('nombre') is-invalid @enderror"
                                        name="nombre" autocomplete="off" value="{{ old('nombre', $curso->nombre) }}">

                                    @error('nombre')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-lg-6">
                                    <label>Activo</label>
                                    <select name="activo" class="form-control">
                                        <option value="1"
                                            {{ old('activo') == '1' || $curso->activo == '1' ? 'selected' : '' }}>
                                            Si</option>
                                        <option value="0"
                                            {{ old('activo') == '0' || $curso->activo == '0' ? 'selected' : '' }}>
                                            No</option>
                                    </select>
                                </div>
                            </div>
                            <input type="hidden" name="curso_id" value="{{ $curso->id }}">
                            <button type="submit" class="btn btn-primary">Actualizar</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- Content Row -->
    </div>
@endsection('content')

@section('agregarModal')
    @include('curso.modal')
@endsection
