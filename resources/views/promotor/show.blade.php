@extends('layout')

@section('title', 'Matriculas promotor')

@section('bread')
    <li class="breadcrumb-item"><a href="{{ route('promotores.index') }}">Promotores</a></li>
    <li class="breadcrumb-item active" aria-current="page">Matrículas</li>
@endsection

@section('content')
    <x-header-0>Matriculas del Promotor: {{ $promotor->nombre }}</x-header-0>

    <x-table>
        @slot('title')
            <th>nombre</th>
            <th>carnet</th>
            <th>Registro</th>
            <th>Estado</th>
            <th></th>
        @endslot
        @forelse ($matriculas as $matricula)
            <tr>
                <td>
                    <i @class([
                        'fas fa-circle fa-sm',
                        'text-primary' => $matricula->activo == 1,
                        'text-danger' => $matricula->activo == 0,
                    ])></i>
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
                <td>
                    <div class="dropdown">
                        <a href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false">
                            Opciones <i class="fas fa-cog"></i>
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                            <a class="dropdown-item"
                                href="{{ route('inscripciones.create', [$matricula->id, 'global']) }}">Inscribir</a>
                            <a class="dropdown-item" href="{{ route('pagos.index', $matricula->id) }}">Pagos</a>
                            <a class="dropdown-item" href="{{ route('matriculas.show', $matricula->id) }}"
                                target="_blank">Detalles</a>

                            <form action="{{ route('cambiar.estado', $matricula->id) }}" method="post">
                                @csrf
                                @method('PUT')
                                <input type="hidden" name="promotor_id" value="{{ $matricula->promotor_id }}">
                                <button type="submit" class="dropdown-item">
                                    {{ $matricula->activo ? 'Desactivar' : 'Activar' }}
                                </button>
                            </form>
                            <a class="dropdown-item" href="{{ route('matriculas.edit', $matricula->id) }}">Editar</a>
                        </ul>
                    </div>
                </td>
            </tr>
        @empty
            <tr>
                <td>No hay registros</td>
            </tr>
        @endforelse
        @slot('links')
            {!! $matriculas->links() !!}
        @endslot
    </x-table>
@endsection
