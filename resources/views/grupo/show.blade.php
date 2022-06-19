@extends('layout')

@section('title', 'Grupo')

@section('content')
    <div class="container-fluid">

        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('index') }}">Inicio</a></li>
                <li class="breadcrumb-item"><a href="{{ route('grupos.index') }}">Grupos</a></li>
                <li class="breadcrumb-item active" aria-current="page">Alumnos</li>
            </ol>
        </nav>

        <div class="row">
            <div class="col-xl-12 col-lg-7">

                <div class="card mb-4">
                    <x-header-2 text="Alumnos">
                        @if (count($alumnos) > 0)
                            <a href="{{ route('notas.show', $grupo_id) }}" class="dropdown-item" target="_blank">Reporte
                                de notas</a>
                        @else
                            <div class="dropdown-header">no hay opciones</div>
                        @endif
                    </x-header-2>

                    {{-- INDEX --}}
                    <x-table-head>
                        <x-slot name="title">
                            <th>Carnet</th>
                            <th>Nombre</th>
                            <th>Notas</th>
                            @if (auth()->user()->rol == 'admin')
                                <th>Pagos</th>
                                <th>Editar</th>
                            @endif
                        </x-slot>
                        <tbody>
                            @foreach ($alumnos as $alumno)
                                <tr>
                                    <td>{{ $alumno->matricula->carnet }}</td>
                                    <td>{{ $alumno->matricula->nombre }}</td>
                                    <td>
                                        <a href="{{ route('notas.create', [$alumno->matricula->id, $grupo_id]) }}"
                                            class="btn btn-sm btn-primary">Notas</a>
                                    </td>
                                    @if (auth()->user()->rol == 'admin')
                                        <td>
                                            <a href="{{ route('pagos.create', [$alumno->matricula->id, $grupo_id]) }}"
                                                class="btn btn-sm btn-secondary">Pagos</a>
                                        </td>
                                        <td>
                                            <a href="{{ route('inscripciones.edit', [$alumno->matricula->id, $grupo_id]) }}"
                                                class="btn btn-sm btn-outline-primary">Editar</a>
                                        </td>
                                    @endif
                                </tr>
                            @endforeach
                        </tbody>
                    </x-table-head>
                </div>
            </div>
        </div>
    </div>
@endsection
