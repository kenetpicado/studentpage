@extends('layout')

@section('title', 'Cambiar grupo')

@section('bread')
    <li class="breadcrumb-item"><a href="{{ route('grupos.index') }}">Grupos</a></li>
    <li class="breadcrumb-item"><a href="{{ route('grupos.show', $inscripcion->grupo_id) }}">Alumnos</a></li>
    <li class="breadcrumb-item active" aria-current="page">Editar</li>
@endsection

@section('content')
    <x-header-0>Editar</x-header-0>

    <x-edit-form ruta='inscripciones.update' :id="$inscripcion->id" btn="Mover">
        <h5 class="mb-3">Mover a un nuevo grupo</h5>
        <x-grupos :grupos="$grupos" :old="$inscripcion->grupo_id" text="Seleccionar grupo"></x-grupos>
        <input type="hidden" name="matricula_id" value="{{ $inscripcion->matricula_id }}">
    </x-edit-form>
    
    <x-edit-form ruta="inscripciones.destroy" :id="$inscripcion->id" btn="Eliminar" method="delete">
        <hr>
        <h5 class="mb-3">Eliminar inscripción</h5>
        <p>
            Esta opción elimina definitivamente la inscripción del alumno en el grupo. Tenga en cuenta que
            también se eliminarán las notas registradas.
        </p>
        <p class="text-primary">
            Esta opción no se puede deshacer.
        </p>
    </x-edit-form>

@endsection
