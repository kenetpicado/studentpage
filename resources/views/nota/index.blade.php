@extends('layout')

@section('title', 'Notas')

@section('bread')
    <li class="breadcrumb-item"><a href="{{ route('grupos.index') }}">Grupos</a></li>
    <li class="breadcrumb-item"><a href="{{ route('grupos.show', $inscripcion->grupo_id) }}">Alumnos</a></li>
    <li class="breadcrumb-item active" aria-current="page">Notas</li>
@endsection

@section('content')
    <x-header-0>Notas</x-header-0>

    <div class="row justify-content-center mb-4">
        <div class="col-lg-6">
            <div class="card-body">
                <p>
                    Todas las notas del alumno:
                </p>
                <h5 class="fw-bolder">{{ $matricula->nombre }}</h5>
                <hr>
                <form action="{{ route('notas.update') }}" method="post">
                    @method('PUT')
                    @csrf
                    <input type="hidden" name="grupo_id" value="{{ $inscripcion->grupo_id }}">
                    <table class="table table-borderless align-middle" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Modulo</th>
                                <th>Nota</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($notas as $key => $nota)
                                <tr>
                                    <td>{{ $nota->modulo }}</td>
                                    <td>
                                        <input type="hidden" name="nota_id[{{ $key }}]"
                                            value="{{ $nota->id }}">

                                        <input type="number"
                                            class="form-control @error('valor.' . $key) is-invalid @enderror"
                                            name="valor[{{ $key }}]"
                                            value="{{ old('valor.' . $key, $nota->valor) }}" min="0" max="100"
                                            required {{ $deny ? 'disabled' : '' }}>

                                        @error('valor.' . $key)
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    @if ($deny)
                        <p class="small text-danger">Actualmente no tiene permisos para editar notas.</p>
                    @else
                        <div class="mb-3">
                            <button type="submit" class="float-end btn btn-primary rounded-3">Guardar</button>
                        </div>
                    @endif
                </form>
            </div>
        </div>
    </div>
@endsection
