@extends('layout')

@section('title', 'Modulos')

@section('bread')
    <li class="breadcrumb-item"><a href="{{ route('cursos.index') }}">Cursos</a></li>
    <li class="breadcrumb-item active" aria-current="page">Modulos</li>
@endsection

@section('content')
    <x-header-modal>Módulos</x-header-modal>

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

    <x-main>
        <p>
            Módulos del Curso:
        </p>
        <h5 class="fw-bolder">{{ $curso->nombre }}</h5>
        <hr>
        <table class="table table-borderless">
            <thead>
                <tr>
                    <th>Módulo</th>
                    <th>Editar</th>
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
    </x-main>
@endsection
