@extends('layout')

@section('title', 'Editar mensaje')

@section('bread')
    <li class="breadcrumb-item"><a href="{{ route('mensajes.grupos') }}">Notificaciones</a></li>
    <li class="breadcrumb-item active" aria-current="page">Editar</li>
@endsection

@section('content')
    <x-header-2 text='Editar'>
        <x-dp-item modal='eliminar' text="Eliminar"></x-dp-item>
    </x-header-2>
    
    <x-modal-delete ruta='mensajes.destroy' :id="$mensaje->id" title="Mensaje">
        <input type="hidden" name="global" value="true">
    </x-modal-delete>

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
        <input type="hidden" name="global" value="true">
    </x-edit-form>
@endsection
