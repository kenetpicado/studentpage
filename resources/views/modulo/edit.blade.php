@extends('layout')

@section('title', 'Editar modulo')

@section('bread')
    <li class="breadcrumb-item"><a href="{{ route('cursos.index') }}">Cursos</a></li>
    <li class="breadcrumb-item"><a href="{{ route('cursos.show', $modulo->curso_id) }}">Modulos</a></li>
    <li class="breadcrumb-item active" aria-current="page">Editar</li>
@endsection

@section('content')
    <x-header-0>Editar</x-header-0>

    <x-form ruta='modulos.update' :id="$modulo->id">
        @method('PUT')
        <x-input name="nombre" :val="$modulo->nombre"></x-input>
        <input type="hidden" name="curso_id" value="{{ $modulo->curso_id }}">
        <input type="hidden" name="modulo_id" value="{{ $modulo->id }}">
    </x-form>

    <x-form ruta="modulos.destroy" :id="$modulo->id" btn="Eliminar">
        @method('DELETE')
        <hr>
        <h5 class="mb-3">Eliminar Módulo</h5>
        <p>
            Solo es posible eliminar un Módulo que no haya sido usado para registrar una nota.
        </p>
        <p class="text-primary">
            Esta opción no se puede deshacer.
        </p>
    </x-form>

@endsection
