@extends('layout')

@section('title', 'Editar mensaje')

@section('bread')
    @if ($type == 'global')
        <li class="breadcrumb-item"><a href="{{ route('mensajes.grupos') }}">Notificaciones</a></li>
        <li class="breadcrumb-item active" aria-current="page">Editar</li>
    @else
        <li class="breadcrumb-item"><a href="{{ route('grupos.index') }}">Grupos</a></li>
        <li class="breadcrumb-item"><a href="{{ route('grupos.show', $mensaje->grupo_id) }}">Alumnos</a></li>
        <li class="breadcrumb-item"><a href="{{ route('mensajes.index', $mensaje->id) }}">Mensajes</a></li>
        <li class="breadcrumb-item active" aria-current="page">Editar</li>
    @endif
@endsection

@section('content')
    <x-header-0>Editar</x-header-0>

    <x-edit-form ruta='mensajes.update' :id="$mensaje->id">
        <div class="mb-3">
            <label class="form-label">Contenido</label>
            <textarea name="contenido" rows="5" class="form-control @error('contenido') is-invalid @enderror">{{ old('contenido', $mensaje->contenido) }}</textarea>

            @error('contenido')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <x-input name="enlace" label="Enlace - (Opcional)" :val="$mensaje->enlace"></x-input>
        <input type="hidden" name="grupo_id" value="{{ $mensaje->grupo_id }}">
    </x-edit-form>

    <x-edit-form ruta="mensajes.destroy" :id="$mensaje->id" btn="Eliminar" method="delete">
        <hr>
        <h5 class="mb-3">Eliminar Mensaje</h5>
        <p class="text-primary">
            Esta opción no se puede deshacer.
        </p>
        <input type="hidden" name="{{ $type }}" value="true">
    </x-edit-form>
@endsection
