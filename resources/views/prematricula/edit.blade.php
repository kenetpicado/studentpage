@extends('layout')

@section('title', 'Editar prematricula')

@section('content')
    <div class="container-fluid">

        {{-- SI HAY MENSAJE DE CONFIRMACION --}}
        @if (session('info'))
            <div class="row">
                <div class="col-lg-12">
                    <div class="card bg-primary text-white shadow mb-2">
                        <div class="card-body">
                            {{ session('info') }}
                        </div>
                    </div>
                </div>
            </div>
        @endif

        <!-- Content Row -->
        <div class="row">
            <form class="col-12" action="{{ route('prematricula.update', $prematricula) }}" method="POST">
                @csrf
                <!-- Datos del alumno -->
                @method('PUT')
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">EDITAR PREMATRICULA</h6>
                    </div>
                    <div class="card-body">

                        <div class="row">
                            <div class="form-group col-6">
                                <label for="id">ID prematricula</label>
                                <input type="text"
                                    class="form-control is-valid" name="id"
                                    autocomplete="off" value="{{ old('id', $prematricula->id) }}" readonly>
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group col-6">
                                <label for="nombre">Nombre completo</label>
                                <input type="text"
                                    class="form-control is-valid @error('nombre') is-invalid @enderror"
                                    name="nombre" autocomplete="off" value="{{ old('nombre', $prematricula->nombre) }}">

                                @error('nombre')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="form-group col-6">
                                <label for="cedula">Cédula</label>
                                <input type="text"
                                    class="form-control @error('cedula') is-invalid @enderror"
                                    name="cedula" autocomplete="off" value="{{ old('cedula', $prematricula->cedula) }}"
                                    placeholder="000-000000-00000">

                                @error('cedula')
                                    <span class="  invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-lg-6">
                                <label for="fecha_nac">Fecha de nacimiento</label>
                                <input type="date"
                                    class="form-control is-valid @error('fecha_nac') is-invalid @enderror"
                                    name="fecha_nac" value="{{ old('fecha_nac', $prematricula->fecha_nac) }}">

                                @error('fecha_nac')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group col-lg-6">
                                <label for="tel">Teléfono</label>
                                <input type="number"
                                    class="form-control @error('tel') is-invalid @enderror"
                                    name="tel" autocomplete="off" value="{{ old('tel', $prematricula->tel) }}"
                                    placeholder="00000000">

                                @error('tel')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="  row">
                            <div class="form-group col-lg-6">
                                <label for="madre">Nombre de la Madre</label>
                                <input type="text"
                                    class="form-control" name="madre"
                                    autocomplete="off" value="{{ old('madre', $prematricula->madre) }}">
                            </div>

                            <div class="form-group col-lg-6">
                                <label for="padre">Nombre del Padre</label>
                                <input type="text"
                                    class="form-control" name="padre"
                                    autocomplete="off" value="{{ old('padre', $prematricula->padre) }}">
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-lg-6">
                                <label for="grado">Último grado aprobado</label>
                                <input type="text"
                                    class="form-control is-valid @error('grado') is-invalid @enderror"
                                    name="grado" autocomplete="off" value="{{ old('grado', $prematricula->grado) }}">

                                @error('grado')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary">Guardar</button>
                        
                        <a href="{{route('prematricula.index')}}" class="btn btn-secondary">Cancelar</a>
                    </div>

                </div>
            </form>
        </div>
        <!-- Content Row -->

    </div>
@endsection('content')
