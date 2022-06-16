@extends('layout')

@section('title', 'Docente')

@section('content')
    <div class="container-fluid">

        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('index') }}">Inicio</a></li>
                <li class="breadcrumb-item"><a href="{{ route('docentes.index') }}">Docentes</a></li>
                <li class="breadcrumb-item active" aria-current="page">Grupos</li>
            </ol>
        </nav>

        <!-- Content Row -->
        <div class="row">
            <form class="col-xl-12 col-lg-7">

                <div class="card mb-4">
                    <x-header-0 text='Grupos'></x-header-0>

                    <x-table-head>
                        <x-slot name="title">
                            <th>Curso</th>
                            <th>Horario</th>
                            <th>Sucursal</th>
                            <th>Año</th>
                        </x-slot>
                        <tbody>
                            @foreach ($grupos as $grupo)
                                <tr>
                                    <td>{{ $grupo->curso->nombre }}</td>
                                    <td>{{ $grupo->horario }}</td>
                                    <td>{{ $grupo->sucursal }}</td>
                                    <td>{{ $grupo->anyo }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </x-table-head>
                </div>
            </form>
        </div>
    </div>
@endsection
