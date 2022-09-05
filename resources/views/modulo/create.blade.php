@extends('layout')

@section('title', 'Agregar modulo')

@section('bread')
    <li class="breadcrumb-item"><a href="{{ route('cursos.index') }}">Cursos</a></li>
    <li class="breadcrumb-item"><a href="{{ route('cursos.show', $curso_id) }}">Modulos</a></li>
    <li class="breadcrumb-item active" aria-current="page">Agregar</li>
@endsection

@section('content')
    <x-header-0>Agregar modulo</x-header-0>

    <x-form ruta='modulos.store'>
        <x-input name="nombre"></x-input>
        <input type="hidden" name="curso_id" value="{{ $curso_id }}">
    </x-form>

@endsection
