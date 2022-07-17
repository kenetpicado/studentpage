@extends('layout')

@section('title', 'Editar curso')

@section('bread')
    <li class="breadcrumb-item"><a href="{{ route('cursos.index') }}">Cursos</a></li>
    <li class="breadcrumb-item active" aria-current="page">Editar</li>
@endsection

@section('content')
    <x-header-2 text='Editar'>
        <x-dp-item modal='eliminar' text="Eliminar"></x-dp-item>
    </x-header-2>
    <x-modal-delete ruta='cursos.destroy' :id="$curso->id" title="Curso"></x-modal-delete>

    <x-edit-form ruta='cursos.update' :id="$curso->id">
        <div class="text-center p-3 mb-3">
            <img src="{{ asset('courses/' . $curso->imagen) }}" style="height: 200px; width: 200px;">
        </div>
        <x-input name="nombre" :val="$curso->nombre"></x-input>
        <x-imagenes :old="$curso->imagen" :imagenes="$imagenes"></x-imagenes>
        <x-check-activo :val="$curso->activo"></x-check-activo>
        <input type="hidden" name="curso_id" value="{{ $curso->id }}">
    </x-edit-form>
@endsection
