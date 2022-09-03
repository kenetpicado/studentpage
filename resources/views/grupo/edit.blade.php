@extends('layout')

@section('title', 'Editar grupo')

@section('bread')
    <li class="breadcrumb-item"><a href="{{ route('grupos.index') }}">Grupos</a></li>
    <li class="breadcrumb-item active" aria-current="page">Editar</li>
@endsection

@section('content')
    <x-header-0>Editar</x-header-0>

    <x-edit-form ruta='grupos.update' :id="$grupo->id">
        <p>
            Cambiar Docente / Horario:
        </p>
        <h5 class="fw-bolder">{{ $curso->nombre }}</h5>
        <hr>
        <x-select-0 name="docente_id" :items="$docentes" text="Docente" :old="$grupo->docente_id"></x-select-0>
        <x-input name="horario" :val="$grupo->horario"></x-input>
    </x-edit-form>

    <x-edit-form ruta="cambiar.estado.grupo" :id="$grupo->id" btn="Cerrar">
        <hr>
        <h4 class="mb-3">Cerrar</h4>
        <p>
            Esta opción establece el grupo como "terminado", de modo que solo debería ejecutarse cuando
            el grupo haya culminado su plan de estudio y no existan más operaciones a realizar.
        </p>
    </x-edit-form>
    
    <x-edit-form ruta="grupos.destroy" :id="$grupo->id" btn="Eliminar" method="delete">
        <hr>
        <h4 class="mb-3">Eliminar</h4>
        <p>
            Solo es posible eliminar un Grupo vacío. De lo contrario primero elimine los alumnos asignados a este grupo.
        </p>
        <p class="text-danger small">
            Esta opción no se puede deshacer.
        </p>
    </x-edit-form>

@endsection
