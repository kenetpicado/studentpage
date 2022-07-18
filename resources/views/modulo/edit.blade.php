@extends('layout')

@section('title', 'Editar modulo')

@section('bread')
    <li class="breadcrumb-item"><a href="{{ route('cursos.index') }}">Cursos</a></li>
    <li class="breadcrumb-item"><a href="{{ route('cursos.show', $modulo->curso_id) }}">Modulos</a></li>
    <li class="breadcrumb-item active" aria-current="page">Editar</li>
@endsection

@section('content')
    <x-header-2 text='Editar'>
        <x-dp-item modal='eliminar' text="Eliminar"></x-dp-item>
    </x-header-2>
    <x-modal-delete ruta='modulos.destroy' :id="$modulo->id" title="Modulo"></x-modal-delete>

    <x-edit-form ruta='modulos.update' :id="$modulo->id">
        <x-input name="nombre" :val="$modulo->nombre"></x-input>
    </x-edit-form>
@endsection
