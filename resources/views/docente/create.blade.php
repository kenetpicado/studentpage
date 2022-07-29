@extends('layout')

@section('title', 'Crear docente')

@section('bread')
    <li class="breadcrumb-item"><a href="{{ route('docentes.index') }}">Docentes</a></li>
    <li class="breadcrumb-item active" aria-current="page">Crear</li>
@endsection

@section('content')
    <x-header-0>Crear docente</x-header-0>
    <x-create-form ruta='docentes.store'>
        <x-input name="nombre"></x-input>
        <x-input name="correo" type="email"></x-input>

        @if (auth()->user()->sucursal == 'all')
            <x-sucursal-form></x-sucursal-form>
        @endif
    </x-create-form>
@endsection
