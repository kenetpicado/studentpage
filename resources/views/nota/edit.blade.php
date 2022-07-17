@extends('layout')

@section('title', 'Editar nota')

@section('bread')
    <li class="breadcrumb-item"><a href="{{ route('grupos.index') }}">Grupos</a></li>
    <li class="breadcrumb-item"><a href="{{ route('grupos.show', $nota->grupo_id) }}">Alumnos</a>
    </li>
    <li class="breadcrumb-item"><a href="{{ route('notas.index', $nota->inscripcion_id) }}">Notas</a></li>
    <li class="breadcrumb-item active" aria-current="page">Editar</li>
@endsection

@section('content')
    <x-header-2 text="Editar">
        <x-dp-item modal='eliminar' text="Eliminar"></x-dp-item>
    </x-header-2>

    <x-modal-delete ruta='notas.destroy' :id="$nota->id" title="Nota">
        <input type="hidden" name="inscripcion" value="{{ $nota->inscripcion_id }}">
    </x-modal-delete>

    <x-edit-form ruta='notas.update' :id="$nota->id">
        <x-input name="num" :val="$nota->num" text="Número de materia (Unidad)" type="number">
        </x-input>
        <x-input name="materia" :val="$nota->materia"></x-input>
        <x-input name="valor" :val="$nota->valor" text="Nota"></x-input>
        <input type="hidden" name="inscripcion_id" value="{{ $nota->inscripcion_id }}">
        <input type="hidden" name="nota_id" value="{{ $nota->id }}">
    </x-edit-form>
@endsection
