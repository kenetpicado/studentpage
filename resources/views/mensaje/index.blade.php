@extends('layout')

@section('title', 'Mensajes')

@section('bread')
    @if ($grupo_id)
        <li class="breadcrumb-item"><a href="{{ route('grupos.index') }}">Grupos</a></li>
        <li class="breadcrumb-item"><a href="{{ route('grupos.show', $grupo_id) }}">Alumnos</a></li>
        <li class="breadcrumb-item active" aria-current="page">Mensajes</li>
    @else
        <li class="breadcrumb-item active" aria-current="page">Mensajes</li>
    @endif
@endsection

@section('content')
    <div class="card-header d-flex align-items-center justify-content-between">
        Todos los Mensajes
        <a class="btn btn-sm btn-primary rounded-3 float-end" data-bs-toggle="modal"
            data-bs-target="#modalCreate">Agregar</a>
    </div>

    <x-modal title="Mensaje - Agregar">
        <form action="{{ route('mensajes.store') }}" method="post">
            @csrf
            <div class="modal-body">
                <div class="mb-3">
                    <label class="form-label">Contenido</label>
                    <textarea name="contenido" rows="5" class="form-control @error('contenido') is-invalid @enderror">{{ old('contenido') }}</textarea>

                    @error('contenido')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <x-input name="enlace" label="Enlace - (Opcional)"></x-input>
                <input type="hidden" name="grupo_id" value="{{ $grupo_id }}">
                <input type="hidden" name="type" value="{{ $type }}">
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary rounded-3">Guardar</button>
            </div>
        </form>
    </x-modal>

    <div class="card-body">
        <table class="table table-borderless" width="100%" cellspacing="0">
            <thead>
                <tr>
                    <th>Mensajes</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($mensajes as $mensaje)
                    <tr>
                        <td>
                            <div style="border-radius: 25px" class="p-3 bg-secondary bg-opacity-10">
                                <div class="small text-primary">
                                    {{ date('d F Y', strtotime($mensaje->created_at)) }} -
                                    {{ $mensaje->from }}:
                                </div>
                                {{ $mensaje->contenido }}
                                @if ($mensaje->enlace)
                                    <a href={{ $mensaje->enlace }} target="_blank">[Ir al enlace]</a>
                                @endif
                                @if ($type == 'global' || $mensaje->grupo_id)
                                    <a href="{{ route('mensajes.edit', [$type, $mensaje->id]) }}">[Editar]</a>
                                @endif
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div class="float-end small">
            {!! $mensajes->links() !!}
        </div>
    </div>
@endsection
