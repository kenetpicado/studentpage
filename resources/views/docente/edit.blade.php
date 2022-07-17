@extends('layout')

@section('title', 'Editar docente')

@section('bread')
    <li class="breadcrumb-item"><a href="{{ route('docentes.index') }}">Docentes</a></li>
    <li class="breadcrumb-item active" aria-current="page">Editar</li>
@endsection

@section('content')
    <x-header-2 text='Editar'>
        <x-dp-item modal='eliminar' text="Eliminar"></x-dp-item>
        <x-dp-item modal='restablecer' text="Restablecer PIN"></x-dp-item>
    </x-header-2>

    <x-modal-delete ruta='docentes.destroy' :id="$docente->id" title="Docente"></x-modal-delete>
    <x-modal-pin :person="$docente" tipo="docentes"></x-modal-pin>

    <x-edit-form ruta='docentes.update' :id="$docente->id">
        <x-input name='nombre' :val="$docente->nombre"></x-input>
        <x-input name='correo' :val="$docente->correo"></x-input>
        <x-check-activo :val="$docente->activo"></x-check-activo>
        <input type="hidden" name="docente_id" value="{{ $docente->id }}">
    </x-edit-form>
@endsection
