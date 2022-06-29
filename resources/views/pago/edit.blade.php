@extends('layout')

@section('title', 'Editar pago')

@section('content')
    <div class="container-fluid">

        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('index') }}">Inicio</a></li>
                <li class="breadcrumb-item"><a href="{{ route('grupos.index') }}">Grupos</a></li>
                <li class="breadcrumb-item"><a href="{{ route('grupos.show', $pago->grupo_id) }}">Alumnos</a>
                </li>
                <li class="breadcrumb-item"><a href="{{ route('pagos.index', $pago->inscripcion_id) }}">Pagos</a></li>
                <li class="breadcrumb-item active" aria-current="page">Editar</li>
            </ol>
        </nav>

        <div class="row">
            <div class="col-xl-12 col-lg-7">

                <div class="card mb-4">
                    <x-header-2 text="Editar">
                        <x-dp-item modal='eliminar' text="Eliminar"></x-dp-item>
                    </x-header-2>

                    {{-- MODAL DELETE --}}
                    <x-modal-delete ruta='pagos.destroy' :id="$pago->id" title="Pago">
                        <input type="hidden" name="inscripcion" value="{{ $pago->inscripcion_id }}">
                    </x-modal-delete>

                    {{-- FORM UPDATE --}}
                    <x-edit-form ruta='pagos.update' :id="$pago->id">
                        <x-input-edit label="concepto" :val="$pago->concepto"></x-input-edit>
                        <x-input-edit label="recibo" :val="$pago->recibo"></x-input-edit>
                        <x-input-edit label="monto" :val="$pago->monto"></x-input-edit>
                    </x-edit-form>
                </div>
            </div>
        </div>
    </div>
@endsection
