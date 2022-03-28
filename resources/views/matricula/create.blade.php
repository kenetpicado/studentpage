@extends('layout')

@section('title', 'Crear matricula')

@section('content')
    <div class="container-fluid">

        {{-- SI HAY MENSAJE DE CONFIRMACION --}}
        @if (session('info'))
            <div class="row">
                <div class="col-lg-12">
                    <div class="card bg-primary text-white shadow mb-2">
                        <div class="card-body">
                            {{ session('info') }}
                        </div>
                    </div>
                </div>
            </div>
        @endif

        <!-- Content Row -->
        <div class="row">
            <form class="col-xl-12 col-lg-7">

                <!-- Datos del alumno -->
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">AGREGAR MATRICULA</h6>
                    </div>

                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Nombre</th>
                                        <th>Fecha de nacimiento</th>
                                        <th>Teléfono</th>
                                        <th>Opción</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($prematriculas as $prematricula)
                                        <tr>
                                            <td>{{ $prematricula->id }}</td>
                                            <td>{{ $prematricula->nombre }}</td>
                                            <td>{{ $prematricula->fecha_nac }}</td>
                                            <td>{{ $prematricula->tel }}</td>
                                            <td class="center-babe"><a href="{{ route('matricular', $prematricula->id) }}"
                                                    class="btn btn-primary">Matricular</a></td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>

                </div>
            </form>
        </div>
        <!-- Content Row -->

    </div>
@endsection('content')
