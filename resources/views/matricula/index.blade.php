@extends('layout')

@section('title', 'Matriculas')

@section('bread')
    <li class="breadcrumb-item active" aria-current="page">Matriculas</li>
@endsection

@section('content')
    <x-header-1 ruta='matriculas.create'>Matriculas</x-header-1>

    <x-table-head>
        <x-slot name="title">
            <th>Nombre</th>
            <th>Carnet</th>
            <th>Registro</th>
            <th>Estado</th>
            <th>Sucursal</th>
            <th></th>
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
                        {{ $matricula->nombre }}
                    </td>
                    <td>{{ $matricula->carnet }}</td>
                    <td>{{ $matricula->created_at }}</td>
                    <td>
                        @if ($matricula->inscripciones_count > 0)
                            <i class="fas fa-check-circle text-primary"></i> Inscrito
                        @else
                            <i class="fas fa-exclamation-circle text-danger"></i> Pendiente
                        @endif
                    </td>
                    <td>{{ $matricula->sucursal }}</td>
                    <td>
                        <div class="dropdown">
                            <a href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown"
                                aria-expanded="false">
                                Opciones <i class="fas fa-cog"></i>
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                @if (auth()->user()->rol == 'admin')
                                    <a class="dropdown-item"
                                        href="{{ route('inscripciones.create', [$matricula->id, 'global']) }}">Inscribir
                                    </a>
                                    <a class="dropdown-item" href="{{ route('pagos.index', $matricula->id) }}">Pagos
                                    </a>
                                    <a class="dropdown-item" href="{{ route('matriculas.show', $matricula->id) }}"
                                        target="_blank">Detalles</a>

                                    <form action="{{ route('cambiar.estado', $matricula->id) }}" method="post">
                                        @csrf
                                        @method('PUT')
                                        <button type="submit" class="dropdown-item">
                                            {{ $matricula->activo ? 'Desactivar' : 'Activar' }}
                                        </button>
                                    </form>
                                @endif

                                <a class="dropdown-item" href="{{ route('matriculas.edit', $matricula->id) }}">Editar</a>
                            </ul>
                        </div>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </x-table-head>
@endsection
