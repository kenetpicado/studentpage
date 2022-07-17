@extends('layout')

@section('title', 'Cambiar grupo')

@section('bread')
    <li class="breadcrumb-item"><a href="{{ route('grupos.index') }}">Grupos</a></li>
    <li class="breadcrumb-item"><a href="{{ route('grupos.show', $inscripcion->grupo_id) }}">Alumnos</a></li>
    <li class="breadcrumb-item active" aria-current="page">Mover</li>
@endsection

@section('content')
    <x-header-2 text="Mover">
        <a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#eliminar">Eliminar
            inscripción</a>
    </x-header-2>

    <x-modal-delete ruta='inscripciones.destroy' :id="$inscripcion->id" title="Inscripción">
        <input type="hidden" name="grupo" value="{{ $inscripcion->grupo_id }}">
    </x-modal-delete>

    <x-edit-form ruta='inscripciones.update' :id="$inscripcion->id" btn="Mover">
        <x-grupos :grupos="$grupos" :old="$inscripcion->grupo_id" text="Mover a"></x-grupos>
        <input type="hidden" name="matricula_id" value="{{ $inscripcion->matricula_id }}">
        <input type="hidden" name="oldview" value="{{ $inscripcion->grupo_id }}">
    </x-edit-form>
    </div>

@endsection
