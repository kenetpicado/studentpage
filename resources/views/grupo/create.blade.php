@extends('layout')

@section('title', 'Crear grupo')

@section('bread')
    <li class="breadcrumb-item"><a href="{{ route('grupos.index') }}">Grupos</a></li>
    <li class="breadcrumb-item active" aria-current="page">Crear</li>
@endsection

@section('content')
<x-header-0>Crear grupo</x-header-0>

<x-create-form ruta='grupos.store'>
    <x-select-0 name="docente_id" :items="$docentes" text="Docente"></x-select-0>
    <x-select-0 name="curso_id" :items="$cursos" text="Curso"></x-select-0>
    <x-input name="horario"></x-input>
</x-create-form>

@endsection
