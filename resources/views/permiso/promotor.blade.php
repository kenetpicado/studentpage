@extends('layout')

@section('title', 'Permisos')

@section('bread')
    <li class="breadcrumb-item"><a href="{{ route('promotores.index') }}">Promotores</a></li>
    <li class="breadcrumb-item active" aria-current="page">Permisos</li>
@endsection

@section('content')
    <x-header-0>Permisos</x-header-0>
    <p class="card-body">
        Permitir o negar el acceso para crear nuevas matriculas.
    </p>
    <x-create-form ruta="permisos.promotor.store">

        <table class="table table-borderless">
            <thead>
                <tr class="text-uppercase small text-primary">
                    <th>Carnet</th>
                    <th>Nombre</th>
                    <th class="text-center">Matricular</th>
                </tr>
            </thead>
            @foreach ($promotores as $key => $promotor)
                <tr>
                    <td>{{ $promotor->email }}</td>
                    <td>{{ $promotor->name }}</td>
                    <td class="text-center">
                        <input type="hidden" name="user_id[{{ $key }}]" value="{{ $promotor->id }}">
                        <input type="hidden" name="permitir[{{ $key }}]" value="0">

                        @if ($promotor->permisos->count() > 0)
                            <div class="form-switch">
                                <input class="form-check-input" type="checkbox" role="switch"
                                    name="permitir[{{ $key }}]" value="1">
                            </div>
                        @else
                            <div class="form-switch">
                                <input class="form-check-input" type="checkbox" role="switch"
                                    name="permitir[{{ $key }}]" value="1" checked>
                            </div>
                        @endif
                    </td>
                </tr>
            @endforeach
        </table>
    </x-create-form>
@endsection
