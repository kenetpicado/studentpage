@extends('layout')

@section('title', 'Editar docente')

@section('content')
    <div class="container-fluid">

        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('index') }}">Inicio</a></li>
                <li class="breadcrumb-item"><a href="{{ route('docentes.index') }}">Docentes</a></li>
                <li class="breadcrumb-item active" aria-current="page">Editar</li>
            </ol>
        </nav>

        <!-- Content Row -->
        <div class="row">
            <div class="col-xl-12 col-lg-7">

                <div class="card mb-4">
                    <x-header-2 text='Editar'>
                        <x-dp-item modal='restablecer' text="Restablecer PIN"></x-dp-item>

                        @if (count($docente->grupos) == 0)
                            <x-dp-item modal='eliminar' text="Eliminar"></x-dp-item>
                        @endif
                    </x-header-2>

                    {{-- MODAL DELETE --}}
                    <x-modal-delete ruta='docentes.destroy' :id="$docente->id" title="Docente"></x-modal-delete>

                    {{-- FORM EDIT --}}
                    <x-edit-form ruta='docentes.update' :id="$docente->id">
                        <x-input-edit label="nombre" :val="$docente->nombre"></x-input-edit>
                        <x-input-edit label="correo" :val="$docente->correo" type="email"></x-input-edit>
                        <x-check-activo :val="$docente->activo"></x-check-activo>
                        <input type="hidden" name="docente_id" value="{{ $docente->id }}">
                    </x-edit-form>
                </div>
            </div>
        </div>
    </div>
@endsection
