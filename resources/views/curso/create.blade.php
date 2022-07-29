@extends('layout')

@section('title', 'Crear curso')

@section('bread')
    <li class="breadcrumb-item"><a href="{{ route('cursos.index') }}">Cursos</a></li>
    <li class="breadcrumb-item active" aria-current="page">Crear</li>
@endsection

@section('content')
    <x-header-0>Crear curso</x-header-0>
    <x-create-form ruta='cursos.store'>
        <x-input name="nombre"></x-input>
        <x-imagenes :imagenes="$imagenes"></x-imagenes>
    </x-create-form>
@endsection
