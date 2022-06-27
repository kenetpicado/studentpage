@extends('layout')

@section('title', 'Docentes')

@section('content')
    <div class="container-fluid">

        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('index') }}">Inicio</a></li>
                <li class="breadcrumb-item active" aria-current="page">Docentes</li>
            </ol>
        </nav>

        <x-message></x-message>

        <!-- Content Row -->
        <div class="row">
            <div class="col-xl-12 col-lg-7">

                <div class="card mb-4">
                    <x-header-1 modelo='Docentes'></x-header-1>

                    {{-- FORM STORE --}}
                    <x-modal-add ruta='docentes.store' title='Docente'>
                        <x-input-form label="nombre"></x-input-form>
                        <x-input-form label="correo" type="email"></x-input-form>

                        @if (auth()->user()->sucursal == 'all')
                            <x-sucursal-form></x-sucursal-form>
                        @endif
                    </x-modal-add>

                    {{-- INDEX --}}
                    <x-table-head>
                        <x-slot name="title">
                            <th>ID</th>
                            <th>Nombre</th>
                            <th>Correo</th>
                            <th>Estado</th>
                            <th>Grupos</th>
                            <th>Editar</th>
                        </x-slot>
                        <tbody>
                            @foreach ($docentes as $docente)
                                <tr>
                                    <td>{{ $docente->carnet }}</td>
                                    <td>{{ $docente->nombre }}</td>
                                    <td>{{ $docente->correo }}</td>
                                    <td>
                                        @if ($docente->activo > 0)
                                            Activo <i class="fas fa-check-circle text-primary"></i>
                                        @else
                                            Inactivo <i class="fas fa-exclamation-circle text-danger"></i>
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{ route('docentes.show', $docente->id) }}"
                                            class="btn btn-primary btn-sm">Grupos</a>
                                    </td>
                                    <td>
                                        <a href="{{ route('docentes.edit', $docente->id) }}"
                                            class="btn btn-outline-primary btn-sm">Editar</a>
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
