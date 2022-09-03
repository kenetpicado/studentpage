@extends('layout')

@section('title', 'Editar docente')

@section('bread')
    <li class="breadcrumb-item"><a href="{{ route('docentes.index') }}">Docentes</a></li>
    <li class="breadcrumb-item active" aria-current="page">Editar</li>
@endsection

@section('content')
    <x-header-0>Editar</x-header-0>

    <x-edit-form ruta='docentes.update' :id="$docente->id">
        <x-input name='nombre' :val="$docente->nombre"></x-input>
        <x-input name='correo' :val="$docente->correo" type="email"></x-input>
        <input type="hidden" name="activo" value="0">
        <div class="form-switch">
            <input class="form-check-input" type="checkbox" role="switch" name="activo" value="1"
                {{ $docente->activo == 1 ? 'checked' :  ''}}>
                <label class="form-check-label">Activo</label>
        </div>
        <input type="hidden" name="docente_id" value="{{ $docente->id }}">
    </x-edit-form>

    <x-create-form ruta="cambiar.pin" btn="Restablecer">
        @method('PUT')
        <hr>
        <h4 class="mb-3">Restablecer PIN</h4>
        <p>
            Esta acción enviará un correo a <strong>{{ $docente->correo }}</strong> con el nuevo PIN generado.
            Esto solo debería usarse en caso que el docente <strong>{{ $docente->nombre }}</strong> haya perdido sus
            credenciales
            y solicite un restablecimiento.
        </p>
        <input type="hidden" name="carnet" value="{{ $docente->carnet }}">
        <input type="hidden" name="correo" value="{{ $docente->correo }}">
        <input type="hidden" name="tipo" value="docentes">
    </x-create-form>

    <x-edit-form ruta="docentes.destroy" :id="$docente->id" btn="Eliminar" method="delete">
        <hr>
        <h4 class="mb-3">Eliminar</h4>
        <p>
            Solo es posible eliminar un Docente que no haya sido asignado a un grupo.
        </p>
        <p class="text-danger small">
            Esta opción no se puede deshacer.
        </p>
    </x-edit-form>
@endsection
