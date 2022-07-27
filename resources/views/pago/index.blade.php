@extends('layout')

@section('title', 'Ver pagos')

@section('bread')
    <li class="breadcrumb-item"><a href="{{ route('matriculas.index') }}">Matriculas</a></li>
    <li class="breadcrumb-item active" aria-current="page">Pagos</li>
@endsection

@section('content')
    <x-header-1>Pagos</x-header-1>

    <x-modal-add ruta='pagos.store' title='Pagos'>
        <x-input name="concepto"></x-input>
        <x-input name="recibo"></x-input>
        <x-input name="monto"></x-input>
        <x-select-0 name="moneda" :items="$monedas"></x-select-0>
        <input type="hidden" name="matricula_id" value="{{ $matricula_id }}">
    </x-modal-add>

    <x-table-head>
        <x-slot name="title">
            <th>Concepto</th>
            <th>Recibo</th>
            <th>Monto</th>
            <th>Moneda</th>
            <th>Fecha</th>
            <th>Recibo</th>
            <th>Editar</th>
        </x-slot>
        <tbody>
            @foreach ($pagos as $pago)
                <tr>
                    <td>{{ $pago->concepto }}</td>
                    <td>{{ $pago->recibo }}</td>
                    <td>{{ $pago->monto }}</td>
                    <td>{{ $pago->moneda }}</td>
                    <td>{{ $pago->created_at }}</td>
                    <td>
                        <a href="#" class="btn btn-sm btn-primary">
                            Ver recibo
                        </a>
                    </td>
                    <td>
                        <a href="{{ route('pagos.edit', $pago->id) }}" class="btn btn-sm btn-outline-primary">
                            Editar
                        </a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </x-table-head>
@endsection
