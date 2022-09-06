@extends('layout')

@section('title', 'Notas')

@section('bread')
    <li class="breadcrumb-item"><a href="{{ route('grupos.index') }}">Grupos</a></li>
    <li class="breadcrumb-item"><a href="{{ route('grupos.show', $inscripcion->grupo_id) }}">Alumnos</a></li>
    <li class="breadcrumb-item active" aria-current="page">Notas</li>
@endsection

@section('content')
    <x-header-0>Notas</x-header-0>

    <x-form ruta="notas.update" :deny="$deny">
        @method('PUT')
        @csrf
        <p>
            Todas las notas del alumno:
        </p>
        <h5 class="fw-bolder">{{ $matricula->nombre }}</h5>
        <hr>

        <input type="hidden" name="grupo_id" value="{{ $inscripcion->grupo_id }}">
        <table class="table table-borderless align-middle" width="100%" cellspacing="0">
            <thead>
                <tr>
                    <th>Modulo</th>
                    <th>Nota</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($notas as $key => $nota)
                    <tr>
                        <td>{{ $nota->modulo }}</td>
                        <td>
                            <input type="hidden" name="nota_id[{{ $key }}]" value="{{ $nota->id }}">

                            <input type="number" class="form-control @error('valor.' . $key) is-invalid @enderror"
                                name="valor[{{ $key }}]" value="{{ old('valor.' . $key, $nota->valor) }}"
                                min="0" max="200" required {{ $deny ? 'disabled' : '' }}>

                            @error('valor.' . $key)
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="2">No se han registado notas</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </x-form>
@endsection
