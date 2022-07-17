@extends('layout')

@section('title', 'Editar grupo')

@section('bread')
    <li class="breadcrumb-item"><a href="{{ route('grupos.index') }}">Grupos</a></li>
    <li class="breadcrumb-item active" aria-current="page">Editar</li>
@endsection

@section('content')
    <x-header-2 text="Editar grupo">
        <a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#cerrar">Cerrar grupo</a>
        <a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#eliminar">Eliminar</a>
    </x-header-2>

    <x-modal-delete ruta='grupos.destroy' :id="$grupo->id" title="Grupo"></x-modal-delete>

    <x-edit-form ruta='grupos.update' :id="$grupo->id">
        <x-select-0 name="docente_id" :items="$docentes" text="Docentes" :old="$grupo->docente_id"></x-select-0>
        <x-input name="horario" :val="$grupo->horario"></x-input>
    </x-edit-form>

    <div class="modal fade" id="cerrar" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Cerrar - Agregar</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('grupos.desactivar', $grupo->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="modal-body">
                        Esta opción establece el grupo como "terminado", de modo que solo debería ejecutarse cuando
                        el grupo haya culminado su plan de estudio y no existan más operaciones a realizar.
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-primary">Guardar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
