@extends('layout')

@section('title', 'Permisos Promotores')

@section('bread')
    <li class="breadcrumb-item"><a href="{{ route('promotores.index') }}">Promotores</a></li>
    <li class="breadcrumb-item active" aria-current="page">Permisos</li>
@endsection

@section('content')
    <x-header-0>Permisos: Promotores</x-header-0>
    <div class="card-body">
        <p>
            Permitir o negar el acceso a crear nuevas Matriculas a un determinado Promotor.
        </p>
        <form action="{{ route('permisos.promotor.store') }}" method="post">
            @csrf
            <table class="table table-borderless" id="no-more-tables" width="100%">
                <thead>
                    <tr>
                        <th>Carnet</th>
                        <th>Nombre</th>
                        <th>Permisos</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($promotores as $key => $promotor)
                        <tr>
                            <input type="hidden" name="user_id[{{ $key }}]" value="{{ $promotor->id }}">
                            <td  data-title="Carnet">{{ $promotor->email }}</td>
                            <td  data-title="Nombre">{{ $promotor->name }}</td>
                            <td>
                                <x-switch deny="create_matricula" :key="$key" :adm="$promotor"
                                    label="Crear nueva Matricula"></x-switch>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="mb-3">
                <button type="submit" class="float-end btn btn-primary rounded-3">Guardar</button>
            </div>
        </form>
    </div>
@endsection
