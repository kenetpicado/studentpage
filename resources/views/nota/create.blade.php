@extends('layout')

@section('title', 'Agregar nota')

@section('bread')
    <li class="breadcrumb-item"><a href="{{ route('grupos.index') }}">Grupos</a></li>
    <li class="breadcrumb-item"><a href="{{ route('grupos.show', $inscripcion->grupo_id) }}">Alumnos</a></li>
    <li class="breadcrumb-item"><a href="{{ route('notas.index', $inscripcion->id) }}">Notas</a></li>
    <li class="breadcrumb-item active" aria-current="page">Agregar</li>
@endsection

@section('content')
    <x-header-0>Agregar nota</x-header-0>

    <x-create-form ruta='notas.store'>
        <x-select-0 name="modulo_id" :items="$modulos" text="Modulo"></x-select-0>
        <x-input name="valor" label="Nota"></x-input>
        <input type="hidden" name="inscripcion_id" value="{{ $inscripcion->id }}">
        <input type="hidden" name="created_at" value="{{ date('Y-m-d') }}">
    </x-create-form>

@endsection
