@extends('layout')

@section('title', 'Modulos')

@section('bread')
    <li class="breadcrumb-item"><a href="{{ route('cursos.index') }}">Cursos</a></li>
    <li class="breadcrumb-item active" aria-current="page">Modulos</li>
@endsection

@section('content')
    <x-header-1 ruta="modulos.create" :id="$curso_id">Modulos</x-header-1>

    <div class="row justify-content-center">
        <div class="col-lg-6">
            <div class="card-body">
                <table class="table table-borderless align-middle"width="100%"
                    cellspacing="0">
                    <thead>
                        <tr class="text-primary text-uppercase small">
                            <th>Nombre</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($modulos as $modulo)
                            <tr>
                                <td>{{ $modulo->nombre }}</td>
                                <td>
                                    <a href="{{ route('modulos.edit', $modulo->id) }}">Editar</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
