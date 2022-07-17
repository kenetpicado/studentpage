@extends('layout')

@section('title', 'Editar pago')

@section('bread')
    <li class="breadcrumb-item"><a href="{{ route('grupos.index') }}">Grupos</a></li>
    <li class="breadcrumb-item"><a href="{{ route('grupos.show', $pago->grupo_id) }}">Alumnos</a>
    </li>
    <li class="breadcrumb-item"><a href="{{ route('pagos.index', $pago->inscripcion_id) }}">Pagos</a></li>
    <li class="breadcrumb-item active" aria-current="page">Editar</li>
@endsection

@section('content')
    <x-header-2 text="Editar">
        <x-dp-item modal='eliminar' text="Eliminar"></x-dp-item>
    </x-header-2>

    <x-modal-delete ruta='pagos.destroy' :id="$pago->id" title="Pago">
        <input type="hidden" name="inscripcion" value="{{ $pago->inscripcion_id }}">
    </x-modal-delete>

    <x-edit-form ruta='pagos.update' :id="$pago->id">
        <x-input name="concepto" :val="$pago->concepto"></x-input>
        <x-input name="recibo" :val="$pago->recibo"></x-input>
        <x-input name="monto" :val="$pago->monto"></x-input>
    </x-edit-form>
@endsection
