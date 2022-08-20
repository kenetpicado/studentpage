@extends('layout')

@section('title', 'Agregar notificacion')

@section('bread')
    @if ($type == 'global')
        <li class="breadcrumb-item"><a href="{{ route('mensajes.index', 'global') }}">Notificaciones</a></li>
        <li class="breadcrumb-item active" aria-current="page">Crear</li>
    @else
        <li class="breadcrumb-item"><a href="{{ route('grupos.index') }}">Grupos</a></li>
        <li class="breadcrumb-item"><a href="{{ route('grupos.show', $grupo_id) }}">Alumnos</a></li>
        <li class="breadcrumb-item"><a href="{{ route('mensajes.index', ['grupo', $grupo_id]) }}">Mensajes</a></li>
        <li class="breadcrumb-item active" aria-current="page">Crear</li>
    @endif
@endsection

@section('content')
    <x-header-0>Agregar mensaje</x-header-0>

    <x-create-form ruta='mensajes.store'>
        <div class="mb-3">
            <label class="form-label">Contenido</label>
            <textarea name="contenido" rows="5" class="form-control @error('contenido') is-invalid @enderror">{{old('contenido')}}</textarea>

            @error('contenido')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <x-input name="enlace" label="Enlace - (Opcional)"></x-input>
        <input type="hidden" name="grupo_id" value="{{ $grupo_id }}">
        <input type="hidden" name="type" value="{{ $type }}">
    </x-create-form>

@endsection
