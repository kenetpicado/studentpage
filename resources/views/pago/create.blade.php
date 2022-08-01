@extends('layout')

@section('title', 'Agregar nota')

@section('bread')
    <li class="breadcrumb-item"><a href="{{ route('matriculas.index') }}">Matriculas</a></li>
    <li class="breadcrumb-item"><a href="{{ route('pagos.index', $matricula_id) }}">Pagos</a></li>
    <li class="breadcrumb-item active" aria-current="page">Agregar</li>
@endsection

@section('content')
    <x-header-0>Agregar pago</x-header-0>

    <x-create-form ruta='pagos.store'>
        <x-input name="concepto"></x-input>
        <x-input name="monto"></x-input>
        <x-select-0 name="moneda" :items="$monedas"></x-select-0>
        <x-select-0 name="grupo_id" :items="$grupos" text="Curso"></x-select-0>
        <input type="hidden" name="matricula_id" value="{{ $matricula_id }}">
    </x-create-form>

@endsection
