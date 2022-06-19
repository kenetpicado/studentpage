@extends('layout')

@section('title', 'Editar grupo')

@section('content')
    <div class="container-fluid">

        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('index') }}">Inicio</a></li>
                <li class="breadcrumb-item"><a href="{{ route('grupos.index') }}">Grupos</a></li>
                <li class="breadcrumb-item active" aria-current="page">Editar</li>
            </ol>
        </nav>

        <div class="row">
            <form class="col-xl-12 col-lg-7">

                <div class="card mb-4">
                    <x-header-2 text="Editar grupo">
                        <a class="dropdown-item" href="#" data-toggle="modal" data-target="#cerrar">Cerrar grupo</a>
                        @if (count($grupo->inscripciones) == 0)
                            <a class="dropdown-item" href="#" data-toggle="modal" data-target="#eliminar">Eliminar</a>
                        @endif
                    </x-header-2>

                     {{-- MODAL DELETE --}}
                     <x-modal-delete ruta='grupos.destroy' :id="$grupo->id" title="Grupo"></x-modal-delete>

                    {{-- FORM UPDATE --}}
                    <x-edit-form ruta='grupos.update' :id="$grupo->id">
                        <div class="row">
                            <x-select-0 label="docente_id" :items="$docentes" text="Docentes" :old="$grupo->docente_id"></x-select-0>
                        </div>
                        <x-input-edit label="horario" :val="$grupo->horario"></x-input-edit>
                    </x-edit-form>
                </div>
            </form>
        </div>

        <!-- MODAL CERRAR GRUPO -->
        <div class="modal fade" id="cerrar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Cerrar - Grupo</h5>
                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <form action="{{ route('grupos.status', $grupo->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="modal-body">
                            Esta opción establece el grupo como "terminado", de modo que solo debería ejecutarse cuando
                            el grupo haya culminado su plan de estudio y no existan más operaciones a realizar.
                        </div>
                        <div class="modal-footer">
                            <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancelar</button>
                            <button type="submit" class="btn btn-primary">Cerrar grupo</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
