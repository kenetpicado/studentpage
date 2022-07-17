@extends('layout')

@section('title', 'Ver pagos')

@section('bread')
    <li class="breadcrumb-item"><a href="{{ route('grupos.index') }}">Grupos</a></li>
    <li class="breadcrumb-item"><a href="{{ route('grupos.show', $inscripcion->grupo_id) }}">Alumnos</a></li>
    <li class="breadcrumb-item active" aria-current="page">Pagos</li>
@endsection

@section('content')
    <x-header-1>Pagos</x-header-1>

    <x-modal-add ruta='pagos.store' title='Pagos'>
        <x-input name="concepto"></x-input>
        <x-input name="recibo"></x-input>
        <x-input name="monto"></x-input>
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
@endsection
