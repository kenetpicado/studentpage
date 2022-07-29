@extends('layout')

@section('title', 'Editar pago')

@section('bread')
    <li class="breadcrumb-item"><a href="{{ route('matriculas.index') }}">Matriculas</a></li>
    <li class="breadcrumb-item"><a href="{{ route('pagos.index', $pago->matricula_id) }}">Pagos</a></li>
    <li class="breadcrumb-item active" aria-current="page">Editar</li>
@endsection

@section('content')
    <x-header-2 text="Editar">
        <x-dp-item modal='eliminar' text="Eliminar"></x-dp-item>
    </x-header-2>
    <x-modal-delete ruta='pagos.destroy' :id="$pago->id" title="Pago"></x-modal-delete>
    <x-edit-form ruta='pagos.update' :id="$pago->id">
        <x-input name="concepto" :val="$pago->concepto"></x-input>
        <x-input name="recibo" :val="$pago->recibo"></x-input>
        <x-input name="monto" :val="$pago->monto"></x-input>
        <x-select-0 name="moneda" :items="$monedas" :old="$pago->moneda"></x-select-0>
    </x-edit-form>
@endsection
