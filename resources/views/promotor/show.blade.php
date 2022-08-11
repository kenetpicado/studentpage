@extends('layout')

@section('title', 'Matriculas promotor')

@section('bread')
    <li class="breadcrumb-item"><a href="{{ route('promotores.index') }}">Promotores</a></li>
    <li class="breadcrumb-item active" aria-current="page">Matrículas</li>
@endsection

@section('content')
    <x-header-2 text="Matriculas">
        <a class="dropdown-item" href="{{ route('reportes.promotor', $promotor_id) }}" target="_blank">Generar reporte</a>
    </x-header-2>

    <x-table-head>
        <x-slot name="title">
            <th>Carnet</th>
            <th>Nombre</th>
            <th>Fecha registro</th>
            <th>Estado</th>
            <th>Opciones</th>
        </x-slot>
        <tbody>
            @foreach ($matriculas as $matricula)
                <tr>
                    <td>
                        @if ($matricula->activo == 1)
                        <i class="fas fa-circle fa-sm text-primary"></i>
                    @else
                        <i class="fas fa-circle fa-sm text-danger"></i>
                    @endif
                        {{ $matricula->carnet }}
                    </td>
                    <td>{{ $matricula->nombre }}</td>
                    <td>{{ $matricula->created_at }}</td>
                    <td>
                        @if ($matricula->inscripciones_count > 0)
                            <i class="fas fa-check-circle text-primary"></i> Inscrito
                        @else
                            <i class="fas fa-exclamation-circle text-danger"></i> Pendiente
                        @endif
                    </td>
                    <td>
                        <div class="dropdown">
                            <button class="btn btn-primary dropdown-toggle btn-sm" type="button" id="dropdownMenuButton1"
                                data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="fas fa-cog"></i>
                            </button>
                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                <a class="dropdown-item"
                                    href="{{ route('inscripciones.create', [$matricula->id, $matricula->promotor_id]) }}">Inscribir
                                </a>
                                <a class="dropdown-item" href="{{ route('matriculas.show', $matricula->id) }}"
                                    target="_blank">Detalles</a>
                                <a class="dropdown-item" href="{{ route('matriculas.edit', $matricula->id) }}">Editar</a>
                            </ul>
                        </div>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </x-table-head>
@endsection
