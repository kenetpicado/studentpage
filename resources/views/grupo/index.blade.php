@extends('layout')

@section('title', 'Grupos')

@section('content')
    <div class="container-fluid">

        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('index') }}">Inicio</a></li>
                <li class="breadcrumb-item active" aria-current="page">Grupos</li>
            </ol>
        </nav>

        <x-message></x-message>

        <div class="row">
            <div class="col-xl-12 col-lg-7">

                <div class="card mb-4">
                    @if (auth()->user()->rol == 'admin')
                        <x-header-2 text="Grupos">
                            <a class="dropdown-item" href="{{ route('grupos.create') }}">Crear grupo</a>
                            <a class="dropdown-item" href="{{ route('grupos.closed') }}">Grupos terminados</a>
                        </x-header-2>
                    @else
                        <x-header-0 text="Grupos"></x-header-0>
                    @endif

                    {{-- INDEX --}}
                    <x-table-head>
                        <x-slot name="title">
                            <th>Curso</th>
                            <th>Docente</th>
                            <th>Horario</th>
                            <th>Año</th>
                            <th>Alumnos</th>
                            @if (auth()->user()->rol == 'admin')
                                <th>Editar</th>
                            @endif
                        </x-slot>
                        <tbody>
                            @foreach ($grupos as $grupo)
                                <tr>
                                    <td>{{ $grupo->curso->nombre }} </td>
                                    <td>{{ $grupo->docente->nombre }}</td>
                                    <td>{{ $grupo->horario }}</td>
                                    <td>{{ $grupo->anyo }}</td>
                                    <td>
                                        <a href="{{ route('grupos.show', $grupo->id) }}"
                                            class="btn btn-sm btn-primary btn-lg btn-block">
                                            Ver {{ count($grupo->inscripciones) }}
                                        </a>
                                    </td>

                                    @if (auth()->user()->rol == 'admin')
                                        <td>
                                            <a href="{{ route('grupos.edit', $grupo->id) }}"
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
