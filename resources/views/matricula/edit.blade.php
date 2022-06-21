@extends('layout')

@section('title', 'Editar matrícula')

@section('content')
    <div class="container-fluid">

        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('index') }}">Inicio</a></li>
                <li class="breadcrumb-item"><a href="{{ route('matriculas.index') }}">Matriculas</a></li>
                <li class="breadcrumb-item active" aria-current="page">Editar</li>
            </ol>
        </nav>

        <x-message></x-message>

        <div class="row">
            <div class="col-xl-12 col-lg-7">

                <div class="card mb-4">
                    <x-header-2 text="Editar">
                        <x-dp-item modal='eliminar' text="Eliminar"></x-dp-item>
                    </x-header-2>

                    {{-- MODAL DELETE --}}
                    <x-modal-delete ruta='matriculas.destroy' :id="$matricula->id" title="Matricula"></x-modal-delete>

                    {{-- FORM EDIT --}}
                    <x-edit-form ruta='matriculas.update' :id="$matricula->id">
                        <x-input-edit label="nombre" :val="$matricula->nombre"></x-input-edit>
                        <x-input-edit label="fecha_nac" text="Fecha de nacimiento" :val="$matricula->fecha_nac" type="date">
                        </x-input-edit>
                        <x-input-edit label="cedula" text="Cédula" :val="$matricula->cedula"></x-input-edit>
                        <x-input-edit label="grado" text="Ultimo grado aprobado" :val="$matricula->grado"></x-input-edit>
                        <x-input-edit label="tutor" :val="$matricula->tutor"></x-input-edit>
                        <x-input-edit label="celular" :val="$matricula->celular"></x-input-edit>
                    </x-edit-form>
                </div>
            </div>
        </div>
    </div>
@endsection
