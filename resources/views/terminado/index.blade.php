@extends('layout')

@section('title', 'Grupos terminados')

@section('content')
    <div class="container-fluid">

        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('index') }}">Inicio</a></li>
                <li class="breadcrumb-item"><a href="{{ route('grupos.index') }}">Grupos</a></li>
                <li class="breadcrumb-item active" aria-current="page">Terminados</li>
            </ol>
        </nav>

        <!-- Content Row -->
        <div class="row">
            <div class="col-xl-12 col-lg-7">

                <div class="card mb-4">
                    <x-header-0 text="Terminados"></x-header-0>

                    <x-table-head>
                        <x-slot name="title">
                            <th>Curso</th>
                            <th>Docente</th>
                            <th>Horario</th>
                            <th>Año</th>
                            <th>Alumnos</th>
                            <th>Opción</th>
                        </x-slot>
                        <tbody>
                            @foreach ($grupos as $grupo)
                                <tr>
                                    <td>{{ $grupo->curso->nombre }}</td>
                                    <td>{{ $grupo->docente->nombre }}</td>
                                    <td>{{ $grupo->horario }}</td>
                                    <td>{{ $grupo->anyo }}</td>
                                    <td>
                                        <a href="{{ route('grupos.thisClosed', $grupo->id) }}">
                                            Ver {{ count($grupo->inscripciones) }} alumnos
                                        </a>
                                    </td>
                                    <td>
                                        <form action="{{ route('grupos.activar', $grupo->id) }}" method="post">
                                            @csrf
                                            @method('PUT')
                                            <button type="submit" class="btn btn-outline-primary btn-sm">Reactivar</button>
                                        </form>
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
