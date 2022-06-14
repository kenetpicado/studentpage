@extends('layout')

@section('title', 'Crear grupo')

@section('content')
    <div class="container-fluid">

        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('index')}}">Inicio</a></li>
                <li class="breadcrumb-item"><a href="{{route('grupos.index')}}">Grupos</a></li>
                <li class="breadcrumb-item active" aria-current="page">Agregar</li>
            </ol>
        </nav>

        <!-- Content Row -->
        <div class="row">
            <div class="col-xl-12 col-lg-7">

                <!-- Datos-->
                <div class="card mb-4">

                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary">Agregar</h6>
                    </div>

                    <div class="card-body">
                        <form action="{{ route('grupos.store') }}" method="POST">
                            @csrf

                            <div class="row">
                                <div class="form-group col-lg-6">
                                    <label for="curso_id">Curso</label>
                                    <select name="curso_id" class="form-control @error('curso_id') is-invalid @enderror">
                                        <option selected disabled value="">Seleccionar</option>
                                        @foreach ($cursos as $curso)
                                            <option value="{{ $curso->id }}"
                                                {{ old('curso_id') == $curso->id ? 'selected' : '' }}>
                                                {{ $curso->nombre }}
                                            </option>
                                        @endforeach
                                    </select>

                                    @error('curso_id')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-lg-6">
                                    <label for="docente_id">Docente</label>
                                    <select name="docente_id"
                                        class="form-control @error('docente_id') is-invalid @enderror">
                                        <option selected disabled value="">Seleccionar</option>
                                        @foreach ($docentes as $docente)
                                            <option value="{{ $docente->id }}"
                                                {{ old('docente_id') == $docente->id ? 'selected' : '' }}>
                                                {{ $docente->nombre }}
                                            </option>
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
                                        name="horario" autocomplete="off" value="{{ old('horario') }}">
                                    @error('horario')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary">Guardar</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- Content Row -->
    </div>
@endsection('content')
