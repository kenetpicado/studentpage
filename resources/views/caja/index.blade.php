@extends('layout')

@section('title', 'Caja')

@section('bread')
    <li class="breadcrumb-item active" aria-current="page">Caja</li>
@endsection

@section('content')
    <x-header-0>Caja</x-header-0>

    <x-form ruta="caja.buscar" btn="Buscar">
        <x-input name="buscar" label="Buscar por Carnet o Nombre"></x-input>
    </x-form>

    <div class="card-body">
        <table class="table table-borderless" width="100%" cellspacing="0">
            <thead>
                <tr>
                    <th>NOMBRE</th>
                    <th>CARNET</th>
                    <th>PAGOS</th>
                </tr>
            </thead>
            <tbody>
                @if (session('matriculas') && count(session('matriculas')) > 0)
                    @foreach (session('matriculas') as $matricula)
                        <tr>
                            <td>{{ $matricula->nombre }}</td>
                            <td>{{ $matricula->carnet }}</td>
                            <td>
                                <a class="btn btn-sm btn-primary" href="{{ route('pagos.index', $matricula->id) }}">Pagos</a>
                            </td>
                        </tr>
                    @endforeach
                @else
                    <tr>
                        <td colspan="3" class="text-center">No hay registros</td>
                    </tr>
                @endif
            </tbody>
        </table>
    </div>
@endsection
