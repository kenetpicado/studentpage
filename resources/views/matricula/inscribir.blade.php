@extends('layout')

@section('title', 'Inscribir')

@section('content')
    <div class="container-fluid">

        <!-- Content Row -->
        <div class="row">
            <div class="col-xl-12 col-lg-7">

                <!-- Datos-->
                <div class="card shadow mb-4">

                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary">INSCRIBIR: {{ $matricula->nombre }}</h6>
                    </div>

                    <div class="card-body">
                        <form action="{{ route('matricula.update', $matricula) }}" method="POST">
                            @csrf
                            @method('PUT')

                            <div class="row">
                                <div class="form-group col-lg-6">
                                    <label>Selecionar grupo</label>

                                    <select name="grupo_id" class="form-control @error('grupo_id') is-invalid @enderror">
                                        <option selected disabled value="">Seleccionar</option>
                                        @foreach ($grupos as $grupo)
                                            <option value="{{ $grupo->id }}">{{ $grupo->curso->nombre }} /
                                                {{ $grupo->horario }} / {{ $grupo->docente->nombre }}</option>
                                        @endforeach
                                    </select>

                                    @error('grupo_id')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <input type="hidden" name="inscribir">
                            <button type="submit" class="btn btn-primary">Guardar</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- Content Row -->
    </div>
@endsection('content')
