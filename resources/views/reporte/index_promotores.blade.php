@extends('layout')

@section('title', 'Reportes Promotores')

@section('bread')
    <li class="breadcrumb-item"><a href="{{ route('reportes.index') }}">Reportes</a></li>
    <li class="breadcrumb-item active" aria-current="page">Promotores</li>
@endsection

@section('content')
    <x-header-0>Promotores</x-header-0>

    <x-main>
        <p>
            Generar reporte de un Promotor específico en un rango de fechas.
            Por favor, ingrese el rango de fechas y carnet del Promotor.
        </p>
        <p>
            Si desea obtener un reporte general de los Promotores <a href="{{ route('reportes.promotorGeneral') }}"
                target="_blank">haga click aqui</a>
        </p>
        <form action="{{ route('reportes.rango.promotor') }}" method="post" target="_blank">
            @csrf
            <x-input name="inicio" type="date"></x-input>
            <x-input name="fin" type="date" :val="date('Y-m-d')"></x-input>
            <x-input name="carnet"></x-input>
            <div class="mb-3">
                <button type="submit" class="float-end btn btn-primary rounded-3">Generar</button>
            </div>
        </form>
    </x-main>

    <x-table>
        @slot('title')
            <th>Nombre</th>
            <th>Carnet</th>
            <th>Correo</th>
            <th></th>
        @endslot
        @foreach ($promotors as $promotor)
            <tr>
                <td>{{ $promotor->nombre }}</td>
                <td>{{ $promotor->carnet }}</td>
                <td>{{ $promotor->correo }}</td>
                <td>
                    <a href="{{ route('reportes.promotor', $promotor->id) }}" target="_blank">Reporte <i
                            class="fas fa-clipboard-check"></i></a>
                </td>
            </tr>
        @endforeach
        @slot('links')
        @endslot
    </x-table>
@endsection
