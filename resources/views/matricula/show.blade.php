@extends('layout')

@section('title', 'Ver matrícula')

@section('content')
    <div class="container-fluid">

        <!-- Content Row -->
        <div class="row">
            <form class="col-xl-12 col-lg-7">
                @csrf

                <!-- Datos-->
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">VER MATRICULA</h6>
                    </div>

                    <div class="card-body" id="imprimible">
                        <div class="row">
                            <div class="form-group col-lg-12">
                                <table class="table table-borderless">
                                    <tr class="center-babe">
                                        <td colspan="4">
                                            <h5> <strong>{{ $centro->nombre }}</strong> </h5>
                                            <h6>Matricula {{date("Y",  strtotime($matricula->created_at))}}</h6>
                                            <h6></h6>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="4">
                                            <h6>Datos del alumno</h6>
                                            <hr>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Carnet:</td>
                                        <td><strong> {{ $matricula->carnet }}</strong></td>
                                        <td>PIN:</td>
                                        <td><strong>{{ $matricula->pin }}</strong></td>
                                    </tr>
                                    <tr>
                                        <td>Nombre: </td>
                                        <td><strong> {{ $matricula->nombre }}</strong></td>
                                        <td>Cédula: </td>
                                        <td><strong>{{ $matricula->cedula }}</strong></td>
                                    </tr>
                                    <tr>
                                        <td>Fecha de nacimiento: </td>
                                        <td><strong> {{ $matricula->fecha_nac }}</strong></td>
                                        <td>Teléfono: </td>
                                        <td><strong>{{ $matricula->tel }}</strong></td>
                                    </tr>
                                    <tr>
                                        <td>Nombre de la Madre: </td>
                                        <td><strong> {{ $matricula->madre }}</strong></td>
                                        <td>Nombre del Padre: </td>
                                        <td><strong>{{ $matricula->padre }}</strong></td>
                                    </tr>
                                    <tr>
                                        <td>Fecha de matrícula: </td>
                                        <td><strong>{{date("Y-m-d",  strtotime($matricula->created_at))}}</strong></td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td colspan="4">
                                            <br>
                                            <h6>Datos del centro</h6>
                                            <hr>
                                        </td>
                                    </tr>
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
