@extends('layout')

@section('title', 'Pagos')

@section('bread')
    <li class="breadcrumb-item"><a href="{{ route('matriculas.index') }}">Matriculas</a></li>
    <li class="breadcrumb-item active" aria-current="page">Pagos</li>
@endsection

@section('content')
    <x-header-1 ruta="pagos.create" :id="$matricula->id">Pagos: {{ $matricula->nombre }}</x-header-1>

    <x-table>
        @slot('title')
            <th>Concepto</th>
            <th>Monto</th>
            <th>Fecha</th>
            <th>Recibo</th>
            <th>Editar</th>
        @endslot
        @foreach ($pagos as $pago)
            <tr>
                <td data-title="Concepto">{{ $pago->concepto }}</td>
                <td data-title="Monto">{{ $pago->monto }} {{ $pago->moneda }}</td>
                <td data-title="Fecha">{{ $pago->created_at }}</td>
                <td><a class="btn btn-sm btn-primary" href="{{ route('recibo', $pago->id) }}" target="_blank">Recibo</a></td>
                <td><a class="btn btn-sm btn-outline-primary" href="{{ route('pagos.edit', $pago->id) }}">Editar</a></td>
            </tr>
        @endforeach
        @slot('links')
            {!! $pagos->links() !!}
        @endslot
    </x-table>
@endsection
