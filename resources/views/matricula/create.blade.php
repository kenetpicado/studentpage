@extends('layout')

@section('title', 'Crear matrícula')

@section('bread')
    <li class="breadcrumb-item"><a href="{{ route('matriculas.index') }}">Matriculas</a></li>
    <li class="breadcrumb-item active" aria-current="page">Crear</li>
@endsection

@section('content')
    <x-header-0>Crear matricula</x-header-0>

        <x-create-form ruta='matriculas.store'>
            <x-input name="nombre"></x-input>
            <x-input name="fecha_nac" label="Fecha de nacimiento" type='date'></x-input>
            <x-input name="cedula"></x-input>
            <x-input name="grado" label="Último grado aprobado"></x-input>
            <x-input name="tutor"></x-input>
            <x-input name="celular" type="number"></x-input>

            @if (auth()->user()->rol == 'admin')
                <x-input name="carnet" label="Carnet - (Opcional)"></x-input>
            @endif

            @if (auth()->user()->sucursal == 'all')
                <x-sucursal-form></x-sucursal-form>
            @endif
        </x-create-form>

    @endsection
