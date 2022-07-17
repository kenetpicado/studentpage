@extends('layout')

@section('title', 'Editar matrícula')

@section('bread')
    <li class="breadcrumb-item"><a href="{{ route('matriculas.index') }}">Matriculas</a></li>
    <li class="breadcrumb-item active" aria-current="page">Editar</li>
@endsection

@section('content')
    <x-header-2 text="Editar">
        <x-dp-item modal='eliminar' text="Eliminar"></x-dp-item>
    </x-header-2>
    <x-modal-delete ruta='matriculas.destroy' :id="$matricula->id" title="Matricula"></x-modal-delete>

    <x-edit-form ruta='matriculas.update' :id="$matricula->id">
        <x-input name="nombre" :val="$matricula->nombre"></x-input>
        <x-input name="fecha_nac" label="Fecha de nacimiento" :val="$matricula->fecha_nac" type="date">
        </x-input>
        <x-input name="cedula" text="Cédula" :val="$matricula->cedula"></x-input>
        <x-input name="grado" text="Ultimo grado aprobado" :val="$matricula->grado"></x-input>
        <x-input name="tutor" :val="$matricula->tutor"></x-input>
        <x-input name="celular" :val="$matricula->celular"></x-input>
    </x-edit-form>

@endsection
