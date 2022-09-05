@extends('layout')

@section('title', 'Editar pago')

@section('bread')
    <li class="breadcrumb-item"><a href="{{ route('matriculas.index') }}">Matriculas</a></li>
    <li class="breadcrumb-item"><a href="{{ route('pagos.index', $pago->matricula_id) }}">Pagos</a></li>
    <li class="breadcrumb-item active" aria-current="page">Editar</li>
@endsection

@section('content')
    <x-header-0>Editar</x-header-0>
    
    <x-form ruta='pagos.update' :id="$pago->id">
        @method('PUT')
        <p>
            Editar pago del Alumno:
        </p>
        <h5 class="fw-bolder">{{ $matricula->nombre }}</h5>
        <hr>
        <x-input name="concepto" :val="$pago->concepto"></x-input>
        <x-input name="monto" :val="$pago->monto"></x-input>
        <x-input name="saldo" :val="$pago->saldo"></x-input>
        <x-select name="moneda" :items="$monedas" :old="$pago->moneda"></x-select>
        <x-select name="grupo_id" :items="$grupos" text="Curso" :old="$pago->grupo_id"></x-select>
    </x-form>

    <x-form ruta="pagos.destroy" :id="$pago->id" btn="Eliminar">
        @method('DELETE')
        <hr>
        <h4 class="mb-3">Eliminar</h4>
        <p class="text-danger small">
            Esta opción no se puede deshacer.
        </p>
    </x-form>
@endsection
