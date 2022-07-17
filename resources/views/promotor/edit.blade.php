@extends('layout')

@section('title', 'Editar promotor')

@section('bread')
    <li class="breadcrumb-item"><a href="{{ route('promotores.index') }}">Promotores</a></li>
    <li class="breadcrumb-item active" aria-current="page">Editar</li>
@endsection

@section('content')
    <x-header-2 text='Editar'>
        <x-dp-item modal='eliminar' text="Eliminar"></x-dp-item>
        <x-dp-item modal='restablecer' text="Restablecer PIN"></x-dp-item>
    </x-header-2>

    <x-modal-delete ruta='promotores.destroy' :id="$promotor->id" title="Promotor"></x-modal-delete>
    <x-modal-pin :person="$promotor" tipo="promotores"></x-modal-pin>

    <x-edit-form ruta='promotores.update' :id="$promotor->id">
        <x-input name="nombre" :val="$promotor->nombre"></x-input>
        <x-input name="correo" :val="$promotor->correo" type="email"></x-input>
        <input type="hidden" name="promotor_id" value="{{ $promotor->id }}">
    </x-edit-form>
@endsection
