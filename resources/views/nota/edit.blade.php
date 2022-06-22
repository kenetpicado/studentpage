@extends('layout')

@section('title', 'Editar nota')

@section('content')
    <div class="container-fluid">

        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('index') }}">Inicio</a></li>
                <li class="breadcrumb-item"><a href="{{ route('grupos.index') }}">Grupos</a></li>
                <li class="breadcrumb-item"><a href="{{ route('grupos.show', $nota->inscripcion->grupo_id) }}">Alumnos</a>
                </li>
                <li class="breadcrumb-item"><a href="{{ route('notas.index', $nota->inscripcion_id) }}">Notas</a></li>
                <li class="breadcrumb-item active" aria-current="page">Editar</li>
            </ol>
        </nav>

        <div class="row">
            <div class="col-xl-12 col-lg-7">

                <div class="card mb-4">
                    <x-header-2 text="Editar">
                        <x-dp-item modal='eliminar' text="Eliminar"></x-dp-item>
                    </x-header-2>

                    {{-- MODAL DELETE --}}
                    <x-modal-delete ruta='notas.destroy' :id="$nota->id" title="Nota">
                        <input type="hidden" name="inscripcion" value="{{ $nota->inscripcion_id }}">
                    </x-modal-delete>


                    {{-- FORM UPDATE --}}
                    <x-edit-form ruta='notas.update' :id="$nota->id">
                        <x-input-edit label="num" :val="$nota->num" text="Número de materia (Unidad)" type="number">
                        </x-input-edit>
                        <x-input-edit label="materia" :val="$nota->materia"></x-input-edit>
                        <x-input-edit label="valor" :val="$nota->valor" text="Nota"></x-input-edit>
                    </x-edit-form>
                </div>
            </div>
        </div>
    </div>
@endsection
