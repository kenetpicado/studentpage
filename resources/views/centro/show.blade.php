@extends('layout')

@section('title', 'Datos del centro')

@section('content')
    <div class="container-fluid">

        {{-- SI HAY MENSAJE DE CONFIRMACION --}}
        @if (session('info'))
            <div class="row">
                <div class="col-lg-12">
                    <div class="card bg-primary text-white shadow mb-2">
                        <div class="card-body">
                            <strong>{{ session('info') }}</strong>
                        </div>
                    </div>
                </div>
            </div>
        @endif

        <!-- Content Row -->
        <div class="row">
            <form class="col-xl-12 col-lg-7">
                @csrf
                <!-- Datos-->
                <div class="card shadow mb-4">

                    <!-- Card Header - Dropdown -->
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary">DATOS DEL CENTRO</h6>
                        <div class="dropdown no-arrow">
                            <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown"
                                aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in"
                                aria-labelledby="dropdownMenuLink">
                                <a class="dropdown-item" href="{{ route('centro.edit', $centro) }}">Editar</a>
                            </div>
                        </div>
                    </div>

                    <div class="card-body" id="imprimible">
                        <div class="row">
                            <div class="form-group col-lg-12">
                                <table class="table table-borderless">
                                    <tr>
                                        <td>Nombre:</td>
                                        <td><strong> {{ $centro->nombre }}</strong></td>
                                        <td>Teléfono: </td>
                                        <td><strong> {{ $centro->tel }}</strong></td>
                                    </tr>
                                    <tr>
                                        <td>Departamento:</td>
                                        <td><strong>{{ $centro->departamento }}</strong></td>
                                        <td>Municipio: </td>
                                        <td><strong> {{ $centro->municipio }}</strong></td>
                                    </tr>
                                    <tr>
                                        <td>Direccion: </td>
                                        <td><strong>{{ $centro->direccion}}</strong></td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
        <!-- Content Row -->

    </div>
@endsection('content')
