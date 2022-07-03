@extends('layout')

@section('title', 'Cambiar grupo')

@section('content')
    <div class="container-fluid">

        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('index') }}">Inicio</a></li>
                <li class="breadcrumb-item"><a href="{{ route('grupos.index') }}">Grupos</a></li>
                <li class="breadcrumb-item"><a href="{{ route('grupos.show', $inscripcion->grupo_id) }}">Alumnos</a></li>
                <li class="breadcrumb-item active" aria-current="page">Mover</li>
            </ol>
        </nav>

        <div class="row">
            <div class="col-xl-12 col-lg-7">

                <div class="card mb-4">
                    <x-header-2 text="Mover">
                        <a class="dropdown-item" href="#" data-toggle="modal" data-target="#eliminar">Eliminar
                            inscripción</a>
                    </x-header-2>

                    {{-- MODAL DELETE --}}
                    <x-modal-delete ruta='inscripciones.destroy' :id="$inscripcion->id" title="Inscripción">
                        <input type="hidden" name="grupo" value="{{ $inscripcion->grupo_id }}">
                    </x-modal-delete>

                    {{-- FORM UPDATE --}}
                    <x-edit-form ruta='inscripciones.update' :id="$inscripcion->id" btn="Mover">
                        <x-grupos :grupos="$grupos" :old="$inscripcion->grupo_id" text="Mover a"></x-grupos>

                        <input type="hidden" name="matricula_id" value="{{ $inscripcion->matricula_id }}">
                        <input type="hidden" name="oldview" value="{{ $inscripcion->grupo_id }}">
                    </x-edit-form>
                </div>
            </div>
        </div>
    </div>
@endsection
