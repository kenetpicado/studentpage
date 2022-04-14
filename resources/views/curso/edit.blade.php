@extends('layout')

@section('title', 'Editar curso')

@section('content')
    <div class="container-fluid">

        @if (count($curso->grupos) == 0)
            <!-- Cabecera -->
        <div class="d-sm-flex align-items-center justify-content-end m-2">
            <button type="button" class="btn btn-sm btn-danger" data-toggle="modal" data-target="#eliminar">
                Eliminar <i class="fas fa-trash ml-1"></i>
            </button>
        </div>
        @endif
        
        <!-- Content Row -->
        <div class="row">
            <div class="col-xl-12 col-lg-7">

                <!-- Datos-->
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">EDITAR CURSO</h6>
                    </div>

                    <div class="card-body">
                        <form action="{{ route('curso.update', $curso) }}" method="POST">
                            @csrf
                            @method('PUT')
                            
                            <div class="row">
                                <div class="form-group col-lg-6">
                                    <label for="nombre">Cambiar nombre del curso</label>
                                    <input type="text" class="form-control is-valid @error('nombre') is-invalid @enderror"
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
                                    <label>Estado</label>
                                    <select name="estado" class="form-control is-valid">
                                        <option value="1"
                                            {{ old('estado') == $curso->estado || $curso->estado == '1' ? 'selected' : '' }}>
                                            Activo</option>
                                        <option value="0"
                                            {{ old('estado') == $curso->estado || $curso->estado == '0' ? 'selected' : '' }}>
                                            Inactivo</option>
                                    </select>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-success">Actualizar</button>
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
