@extends('layout')

@section('title', 'Crear promotor')

@section('bread')
    <li class="breadcrumb-item"><a href="{{ route('promotores.index') }}">Promotores</a></li>
    <li class="breadcrumb-item active" aria-current="page">Crear</li>
@endsection

@section('content')
    <x-header-0>Crear promotor</x-header-0>
    <x-create-form ruta='promotores.store'>
        <x-input name="nombre"></x-input>
        <x-input name="correo" type="email"></x-input>
    </x-create-form>
@endsection
