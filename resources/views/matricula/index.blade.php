@extends('layout')

@section('title', 'Matriculas')

@section('content')
    <div class="container-fluid">

        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('index') }}">Inicio</a></li>
                <li class="breadcrumb-item active" aria-current="page">Matriculas</li>
            </ol>
        </nav>

        <x-message></x-message>

        <div class="row">
            <div class="col-xl-12 col-lg-7">

                <div class="card mb-4">
                    <x-header-1 modelo='Matriculas'></x-header-1>

                    <x-modal-add ruta='matriculas.store' title='Matrícula' lg='modal-lg'>
                        <div class="row">
                            <x-input-form label="nombre" class="col-lg-6"></x-input-form>
                            <x-input-form label="fecha_nac" text="Fecha de nacimiento" class="col-lg-6" type='date'>
                            </x-input-form>
                        </div>

                        <div class="row">
                            <x-input-form label="cedula" text="Cédula" class="col-lg-6"></x-input-form>
                            <x-input-form label="grado" text="Último grado aprobado" class="col-lg-6"></x-input-form>
                        </div>

                        <div class="row">
                            <x-input-form label="tutor" class="col-lg-6"></x-input-form>
                            <x-input-form label="celular" class="col-lg-6" type="number"></x-input-form>
                        </div>

                        <div class="row">
                            @if (auth()->user()->rol == 'admin')
                                <x-input-form label="carnet" text="Carnet - (Opcional)" class="col-lg-6">
                                </x-input-form>
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
                                        <div class="dropdown no-arrow">
                                            <a class="dropdown-toggle btn btn-primary btn-sm" href="#" role="button"
                                                id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true"
                                                aria-expanded="false">
                                                <i class="fas fa-cog"></i>
                                            </a>
                                            <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in"
                                                aria-labelledby="dropdownMenuLink">
                                                {{-- Solo el administrador puede inscribir --}}
                                                @if (auth()->user()->rol == 'admin')
                                                    <a class="dropdown-item"
                                                        href="{{ route('inscripciones.create', [$matricula->id, 'global']) }}">Inscribir
                                                    </a>

                                                    <a class="dropdown-item"
                                                        href="{{ route('matriculas.show', $matricula->id) }}"
                                                        target="_blank">Detalles</a>
                                                @endif

                                                <a class="dropdown-item"
                                                    href="{{ route('matriculas.edit', $matricula->id) }}">Editar</a>
                                            </div>
                                        </div>
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
