@extends('layout')

@section('title', 'Modulos')

@section('bread')
    <li class="breadcrumb-item"><a href="{{ route('cursos.index') }}">Cursos</a></li>
    <li class="breadcrumb-item active" aria-current="page">Modulos</li>
@endsection

@section('content')
    <div class="card-header d-flex align-items-center justify-content-between border-0">
        Modulos del Curso: {{ $curso->nombre }}
        <button type="button" class="btn btn-sm btn-primary rounded-3 float-end" data-bs-toggle="modal"
            data-bs-target="#modalCreate">
            Agregar
        </button>
    </div>

    <x-modal title="Modulo - Agregar">
        <form action="{{ route('modulos.store') }}" method="post">
            @csrf
            <div class="modal-body">
                <x-input name="nombre"></x-input>
                <input type="hidden" name="curso_id" value="{{ $curso->id }}">
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary rounded-3">Guardar</button>
            </div>
        </form>
    </x-modal>

    <div class="row justify-content-center">
        <div class="col-lg-6">
            <div class="card-body">
                <table class="table table-borderless align-middle"width="100%" cellspacing="0">
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
                                    <a class="btn btn-sm btn-primary" href="{{ route('modulos.edit', $modulo->id) }}">Editar</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
