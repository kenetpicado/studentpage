@extends('layout')

@section('title', 'Matriculas')

@section('bread')
    <li class="breadcrumb-item active" aria-current="page">Matriculas</li>
@endsection

@section('content')
    <x-header-1>Matriculas</x-header-1>
    <x-modal-add ruta='matriculas.store' title='Matrícula' lg='modal-lg'>
        <div class="row">
            <x-input name="nombre" class="col-lg-6"></x-input>
            <x-input name="fecha_nac" label="Fecha de nacimiento" class="col-lg-6" type='date'></x-input>
        </div>

        <div class="row">
            <x-input name="cedula" class="col-lg-6"></x-input>
            <x-input name="grado" label="Último grado aprobado" class="col-lg-6"></x-input>
        </div>

        <div class="row">
            <x-input name="tutor" class="col-lg-6"></x-input>
            <x-input name="celular" class="col-lg-6" type="number"></x-input>
        </div>

        <div class="row">
            @if (auth()->user()->rol == 'admin')
                <x-input name="carnet" text="Carnet - (Opcional)" class="col-lg-6"></x-input>
            @endif

            @if (auth()->user()->sucursal == 'all')
                <x-sucursal-form class="col-lg-6"></x-sucursal-form>
            @endif
        </div>
    </x-modal-add>

    <x-table-head>
        <x-slot name="title">
            <th>Carnet</th>
            <th>Nombre</th>
            <th>Fecha registro</th>
            <th>Estado</th>
            <th>Mas</th>
        </x-slot>
        <tbody>
            @foreach ($matriculas as $matricula)
                <tr>
                    <td>{{ $matricula->carnet }}</td>
                    <td>{{ $matricula->nombre }}</td>
                    <td>{{ $matricula->created_at }}</td>
                    <td>
                        @if ($matricula->inscripciones_count > 0)
                            Inscrito <i class="fas fa-check-circle text-primary"></i>
                        @else
                            Pendiente <i class="fas fa-exclamation-circle text-danger"></i>
                        @endif
                    </td>
                    <td>
                        <div class="dropdown">
                            <button class="btn btn-primary dropdown-toggle btn-sm" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown"
                                aria-expanded="false">
                                <i class="fas fa-cog"></i>
                            </button>
                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                @if (auth()->user()->rol == 'admin')
                                    <a class="dropdown-item"
                                        href="{{ route('inscripciones.create', [$matricula->id, 'global']) }}">Inscribir
                                    </a>
                                    <a class="dropdown-item"
                                        href="{{ route('pagos.index', $matricula->id) }}">Pagos
                                    </a>
                                    <a class="dropdown-item" href="{{ route('matriculas.show', $matricula->id) }}"
                                        target="_blank">Detalles</a>
                                @endif

                                <a class="dropdown-item" href="{{ route('matriculas.edit', $matricula->id) }}">Editar</a>
                            </ul>
                        </div>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </x-table-head>
@endsection
