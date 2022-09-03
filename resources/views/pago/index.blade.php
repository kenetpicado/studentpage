@extends('layout')

@section('title', 'Pagos')

@section('bread')
    <li class="breadcrumb-item"><a href="{{ route('matriculas.index') }}">Matriculas</a></li>
    <li class="breadcrumb-item active" aria-current="page">Pagos</li>
@endsection

@section('content')
    <x-header-1 ruta="pagos.create" :id="$matricula->id">Pagos: {{ $matricula->nombre }}</x-header-1>

    <x-table-head>
        <x-slot name="title">
            <th>Concepto</th>
            <th>Monto</th>
            <th>Fecha</th>
            <th></th>
        </x-slot>
        <tbody>
            @foreach ($pagos as $pago)
                <tr>
                    <td>{{ $pago->concepto }}</td>
                    <td>{{ $pago->monto }} {{ $pago->moneda }}</td>
                    <td>{{ $pago->created_at }}</td>
                    <td>
                        <div class="dropdown">
                            <a href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown"
                                aria-expanded="false">
                                Opciones <i class="fas fa-cog"></i>
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                <a href="{{ route('recibo', $pago->id) }}" target="_blank" class="dropdown-item">Ver
                                    recibo</a>
                                <a href="{{ route('pagos.edit', $pago->id) }}" class="dropdown-item">Editar</a>
                            </ul>
                        </div>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </x-table-head>
@endsection
