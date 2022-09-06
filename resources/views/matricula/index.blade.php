@extends('layout')

@section('title', 'Matriculas')

@section('bread')
    <li class="breadcrumb-item active" aria-current="page">Matriculas</li>
@endsection

@section('content')
    <x-header-1 ruta='matriculas.create'>Todas las Matriculas</x-header-1>

    <x-table search="search.matriculas">
        @slot('title')
            <th>Nombre</th>
            <th>Carnet</th>
            <th>Registro</th>
            <th>Estado</th>
            <th></th>
        @endslot
        @forelse ($matriculas as $matricula)
            <tr>
                <td data-title="Nombre">
                    <i @class([
                        'fas fa-circle fa-sm',
                        'text-primary' => $matricula->activo == 1,
                        'text-danger' => $matricula->activo == 0,
                    ])></i>
                    {{ $matricula->nombre }}
                </td>
                <td data-title="Carnet">{{ $matricula->carnet }}</td>
                <td data-title="Registro">{{ $matricula->created_at }}</td>
                <td>
                    @if ($matricula->inscripciones_count > 0)
                        <i class="fas fa-check-circle text-primary"></i> Inscrito
                    @else
                        <i class="fas fa-exclamation-circle text-danger"></i> Pendiente
                    @endif
                </td>
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
                                    <input type="hidden" name="global">
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
        @empty
            <tr>
                <td colspan="5">No hay registros</td>
            </tr>
        @endforelse
        @slot('links')
            {!! $matriculas->links() !!}
        @endslot
    </x-table>
@endsection
