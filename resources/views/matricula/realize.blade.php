@extends('layout')

@section('title', 'Matricular')

@section('content')
    <div class="container-fluid">
        <!-- Content Row -->
        <div class="row">
            <form class="col-12" action="{{ route('matricula.store') }}" method="POST">
                @csrf
                <!-- Datos de la matricula-->
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">MATRICULAR ALUMNO</h6>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="form-group col-6">
                                <label for="prematricula_id">ID prematrícula</label>
                                <input type="text"
                                    class="form-control is-valid @error('prematricula_id') is-invalid @enderror"
                                    name="prematricula_id" autocomplete="off" value="{{ $prematricula->id }}" readonly>
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group col-6">
                                <label for="nombre">Nombre</label>
                                <input type="text"
                                    class="form-control is-valid @error('prematricula_id') is-invalid @enderror"
                                    name="nombre" autocomplete="off" value="{{ $prematricula->nombre }}" readonly>

                                @error('prematricula_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group col-6">
                                <label for="fecha_nac">Fecha de nacimiento</label>
                                <input type="text"
                                    class="form-control is-valid @error('prematricula_id') is-invalid @enderror"
                                    name="fecha_nac" autocomplete="off" value="{{ $prematricula->fecha_nac }}" readonly>
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group col-lg-6">
                                <label for="grupo_id">Seleccionar curso y grupo</label>
                                <select name="grupo_id" class="form-control @error('grupo_id') is-invalid @enderror">
                                    <option selected disabled value="">Seleccionar</option>
                                    @foreach ($grupos as $grupo)
                                        <option value="{{ $grupo->id }}"
                                            {{ old('grupo_id') == $grupo->id ? 'selected' : '' }}>{{ $grupo->curso->nombre }} -
                                            {{ $grupo->numero }}</option>
                                    @endforeach
                                </select>

                                @error('grupo_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group col-lg-6">
                                <label for="manual">Manual de usuario</label>
                                <select name="manual" class="form-control">
                                    <option selected value="NO">NO</option>
                                    <option value="SI">SI</option>
                                </select>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary">Matricular</button>
                    </div>
                </div>
            </form>
        </div>
        <!-- Content Row -->
    </div>
@endsection('content')
