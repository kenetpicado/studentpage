@extends('layout')

@section('title', 'Editar curso')

@section('bread')
    <li class="breadcrumb-item"><a href="{{ route('cursos.index') }}">Cursos</a></li>
    <li class="breadcrumb-item active" aria-current="page">Editar</li>
@endsection

@section('content')
    <x-header-0>Editar</x-header-0>

    <x-edit-form ruta='cursos.update' :id="$curso->id">
        
        <x-input name="nombre" :val="$curso->nombre"></x-input>
        <x-imagenes :old="$curso->imagen" :imagenes="$imagenes"></x-imagenes>
        <x-check-activo :val="$curso->activo"></x-check-activo>
        <div class="text-center p-3 mb-3">
            <img src="{{ asset('courses/' . $curso->imagen) }}" style="height: 200px; width: 200px;">
        </div>
        <input type="hidden" name="curso_id" value="{{ $curso->id }}">
    </x-edit-form>

    <x-edit-form ruta="cursos.destroy" :id="$curso->id" btn="Eliminar" method="delete">
        <hr>
        <h4 class="mb-3">Eliminar</h4>
        <p>
            Solo es posible eliminar un Curso que no tenga Grupos asignados.
        </p>
        <p class="text-danger small">
            Esta opción no se puede deshacer.
        </p>
    </x-edit-form>
@endsection
