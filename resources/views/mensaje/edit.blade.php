@extends('layout')

@section('title', 'Editar mensaje')

@section('content')
    <div class="container-fluid">

        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('index') }}">Inicio</a></li>
                <li class="breadcrumb-item"><a href="{{ route('grupos.index') }}">Grupos</a></li>
                <li class="breadcrumb-item"><a href="{{ route('grupos.show', $mensaje->grupo_id) }}">Alumnos</a></li>
                <li class="breadcrumb-item"><a href="{{ route('mensajes.index', $mensaje->id) }}">Mensajes</a></li>
                <li class="breadcrumb-item active" aria-current="page">Editar</li>
            </ol>
        </nav>

        <x-error></x-error>
        <!-- Content Row -->
        <div class="row">
            <div class="col-xl-12 col-lg-7">

                <div class="card mb-4">
                    <x-header-2 text='Editar'>
                        <x-dp-item modal='eliminar' text="Eliminar"></x-dp-item>
                    </x-header-2>

                    {{-- MODAL DELETE --}}
                    <x-modal-delete ruta='mensajes.destroy' :id="$mensaje->id" title="Mensaje"></x-modal-delete>

                    {{-- FORM EDIT --}}
                    <x-edit-form ruta='mensajes.update' :id="$mensaje->id">

                        <div class="row">
                            <div class="form-group col-lg-6">
                                <label>Contenido</label>
                                <textarea name="contenido" rows="5" class="form-control @error('contenido') is-invalid @enderror">{{ old('contenido', $mensaje->contenido) }}</textarea>

                                @error('contenido')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <x-input-edit label="enlace" text="Enlace - (Opcional)" :val="$mensaje->enlace"></x-input-edit>
                        <input type="hidden" name="grupo_id" value="{{ $mensaje->grupo_id }}">
                    </x-edit-form>
                </div>
            </div>
        </div>
    </div>
@endsection
