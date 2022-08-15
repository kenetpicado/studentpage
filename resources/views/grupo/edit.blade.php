@extends('layout')

@section('title', 'Editar grupo')

@section('bread')
    <li class="breadcrumb-item"><a href="{{ route('grupos.index') }}">Grupos</a></li>
    <li class="breadcrumb-item active" aria-current="page">Editar</li>
@endsection

@section('content')
    <x-header-2 text="Editar grupo">
        <a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#eliminar">Eliminar</a>
    </x-header-2>

    <x-modal-delete ruta='grupos.destroy' :id="$grupo->id" title="Grupo"></x-modal-delete>

    <x-edit-form ruta='grupos.update' :id="$grupo->id">
        <x-select-0 name="docente_id" :items="$docentes" text="Docentes" :old="$grupo->docente_id"></x-select-0>
        <x-input name="horario" :val="$grupo->horario"></x-input>
    </x-edit-form>

    <x-edit-form ruta="cambiar.estado.grupo" :id="$grupo->id" btn="Cerrar grupo">
        <hr>
        <h4 class="mb-3">Cerrar grupo</h4>
        <p>
            Esta opción establece el grupo como "terminado", de modo que solo debería ejecutarse cuando
            el grupo haya culminado su plan de estudio y no existan más operaciones a realizar.
        </p>
    </x-edit-form>
@endsection
