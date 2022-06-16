@extends('layout')

@section('title', 'Promotores')

@section('content')
    <div class="container-fluid">

        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('index') }}">Inicio</a></li>
                <li class="breadcrumb-item active" aria-current="page">Promotores</li>
            </ol>
        </nav>

        <!-- Content Row -->
        <div class="row">
            <div class="col-xl-12 col-lg-7">

                <!-- Datos  -->
                <div class="card mb-4">
                    <x-header-1 modelo='Promotores'></x-header-1>

                    <x-modal-add ruta='promotores.store' title='Promotor'>
                        <x-input-form label="nombre"></x-input-form>
                        <x-input-form label="correo"></x-input-form>
                    </x-modal-add>

                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-borderless" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Nombre</th>
                                        <th>Correo</th>
                                        <th>Matriculas</th>
                                        <th>Editar</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($promotors as $promotor)
                                        <tr>
                                            <td>{{ $promotor->carnet }}</td>
                                            <td>{{ $promotor->nombre }}</td>
                                            <td>{{ $promotor->correo }}</td>
                                            <td>
                                                <a href="{{ route('promotores.show', $promotor->id) }}"
                                                    class="btn btn-primary btn-sm">Matriculas</a>
                                            </td>
                                            <td>
                                                <a href="{{ route('promotores.edit', $promotor->id) }}"
                                                    class="btn btn-outline-primary btn-sm">Editar</a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection('content')

@section('re-open')
    @if ($errors->any())
        <script>
            $('#agregar').modal('show')
        </script>
    @endif
@endsection
