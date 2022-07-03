@extends('layout')

@section('title', 'Editar curso')

@section('content')
    <div class="container-fluid">

        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('index') }}">Inicio</a></li>
                <li class="breadcrumb-item"><a href="{{ route('cursos.index') }}">Cursos</a></li>
                <li class="breadcrumb-item active" aria-current="page">Editar</li>
            </ol>
        </nav>

        <x-error></x-error>
        <!-- Content Row -->
        <div class="row">
            <div class="col-xl-12 col-lg-7">

                <div class="card mb-4">
                    <x-header-2 text='Editar'>
                        <x-dp-item modal='eliminar' text="Eliminar"></x-dp-item>
                    </x-header-2>

                    {{-- MODAL DELETE --}}
                    <x-modal-delete ruta='cursos.destroy' :id="$curso->id" title="Curso"></x-modal-delete>

                    <div class="row">
                        <div class="col">
                            <x-edit-form ruta='cursos.update' :id="$curso->id" class="col-lg-12">
                                <x-input-edit class="col-lg-12" label="nombre" :val="$curso->nombre"></x-input-edit>
                                <div class="row">
                                    <x-imagenes :old="$curso->imagen" class="col-lg-12" :imagenes="$imagenes"></x-imagenes>
                                </div>
                                <x-check-activo :val="$curso->activo"></x-check-activo>
                                <input type="hidden" name="curso_id" value="{{ $curso->id }}">
                            </x-edit-form>
                        </div>

                        <div class="col">
                            <div class="text-center">
                                <img src="{{ asset('courses/' . $curso->imagen) }}" style="height: 250px; width: 250px;">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
