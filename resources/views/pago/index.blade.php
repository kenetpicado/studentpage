@extends('layout')

@section('title', 'Ver pagos')

@section('content')
    <div class="container-fluid">

        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('index') }}">Inicio</a></li>
                <li class="breadcrumb-item"><a href="{{ route('grupos.index') }}">Grupos</a></li>
                <li class="breadcrumb-item"><a href="{{ route('grupos.show', $inscripcion->grupo_id) }}">Alumnos</a></li>
                <li class="breadcrumb-item active" aria-current="page">Pagos</li>
            </ol>
        </nav>
        <x-message></x-message>
        <div class="row">
            <div class="col-xl-12 col-lg-7">

                <div class="card mb-4">
                    <x-header-1 modelo="Pagos"></x-header-1>

                    {{-- FORM STORE --}}
                    <x-modal-add ruta='pagos.store' title='Pagos'>
                        <x-input-form label="concepto"></x-input-form>
                        <x-input-form label="recibo"></x-input-form>
                        <x-input-form label="monto"></x-input-form>
                        <input type="hidden" name="inscripcion_id" value="{{ $inscripcion->id }}">
                    </x-modal-add>

                    <x-table-head>
                        <x-slot name="title">
                            <th>Concepto</th>
                            <th>Recibo</th>
                            <th>Monto C$</th>
                            <th>Fecha</th>
                            <th>Editar</th>
                        </x-slot>
                        <tbody>
                            @foreach ($inscripcion->pagos as $pago)
                                <tr>
                                    <td>{{ $pago->concepto }}</td>
                                    <td>{{ $pago->recibo }}</td>
                                    <td>{{ $pago->monto }}</td>
                                    <td>{{ $pago->created_at }}</td>
                                    <td>
                                        <a href="{{ route('pagos.edit', $pago->id) }}" class="btn btn-sm btn-primary">
                                            Editar
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </x-table-head>
                </div>
            </div>
        </div>
    </div>
@endsection
<x-open-modal></x-open-modal>
