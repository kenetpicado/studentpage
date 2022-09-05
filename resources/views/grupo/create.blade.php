@extends('layout')

@section('title', 'Crear Grupo')

@section('bread')
    <li class="breadcrumb-item"><a href="{{ route('grupos.index') }}">Grupos</a></li>
    <li class="breadcrumb-item active" aria-current="page">Crear</li>
@endsection

@section('content')
<x-header-0>Crear Grupo</x-header-0>

<x-form ruta='grupos.store'>
    <x-select name="docente_id" :items="$docentes" text="Docente"></x-select>
    <x-select name="curso_id" :items="$cursos" text="Curso"></x-select>
    <x-input name="horario"></x-input>
</x-form>

@endsection
