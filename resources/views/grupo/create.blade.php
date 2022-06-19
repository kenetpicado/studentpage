@extends('layout')

@section('title', 'Crear grupo')

@section('content')
    <div class="container-fluid">

        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('index')}}">Inicio</a></li>
                <li class="breadcrumb-item"><a href="{{route('grupos.index')}}">Grupos</a></li>
                <li class="breadcrumb-item active" aria-current="page">Crear</li>
            </ol>
        </nav>

        <div class="row">
            <div class="col-xl-12 col-lg-7">

                <div class="card mb-4">
                    <x-header-0 text="Crear grupo"></x-header-0>

                    {{-- FORM STORE --}}
                    <x-create-form ruta='grupos.store'>
                        <div class="row">
                            <x-select-0 label="docente_id" :items="$docentes" text="Docentes"></x-select-0>
                        </div>
                        <div class="row">
                            <x-select-0 label="curso_id" :items="$cursos" text="Cursos"></x-select-0>
                        </div>
                        <div class="row">
                            <x-input-form label="horario" class="col-lg-6"></x-input-form>
                        </div>
                    </x-create-form>
                </div>
            </div>
        </div>
    </div>
@endsection
