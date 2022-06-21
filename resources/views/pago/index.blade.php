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

        <div class="row">
            <div class="col-xl-12 col-lg-7">

                <div class="card mb-4">
                    <x-header-1 modelo="Pagos"></x-header-1>

                    {{-- FORM STORE --}}
                    <x-modal-add ruta='pagos.store' title='Pagos'>

                        <div class="row">
                            <div class="form-group col-lg-6">
                                <label>Tipo</label>
                                <select name="tipo" id="tipo"
                                    class="form-control @error('tipo') is-invalid @enderror">
                                    <option value="1" {{ old('tipo') == '1' ? 'selected' : '' }}>MENSUALIDAD</option>
                                    <option value="0" {{ old('tipo') == '0' ? 'selected' : '' }}>OTRO</option>
                                </select>
                            </div>
                            <div class="form-group col-lg-6">
                                <label>Concepto</label>
                                <input type="text" id="concepto"
                                    class="form-control @error('concepto') is-invalid @enderror" name="concepto" disabled
                                    autocomplete="off" value="{{ old('concepto') }}">

                                @error('concepto')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

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
                        </x-slot>
                        <tbody>
                            @foreach ($inscripcion->pagos as $pago)
                                <tr>
                                    <td>{{ $pago->concepto }}</td>
                                    <td>{{ $pago->recibo }}</td>
                                    <td>{{ $pago->monto }}</td>
                                    <td>{{ $pago->created_at }}</td>
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
