@extends('layout')

@section('title', 'Agregar notificacion')

@section('bread')
    <li class="breadcrumb-item"><a href="{{ route('mensajes.grupos') }}">Notificaciones</a></li>
    <li class="breadcrumb-item active" aria-current="page">Agregar</li>
@endsection

@section('content')
    <x-header-0>Agregar notificacion</x-header-0>

    <x-create-form ruta='mensajes.store'>
        <div class="mb-3">
            <label class="form-label">Contenido</label>
            <textarea name="contenido" rows="5" class="form-control @error('contenido') is-invalid @enderror"></textarea>

            @error('contenido')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <input type="hidden" name="global" value="true">
        <x-input name="enlace" label="Enlace - (Opcional)"></x-input>
    </x-create-form>

@endsection
