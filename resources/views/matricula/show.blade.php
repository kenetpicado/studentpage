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
                                            <h5> <strong>INTITUTO TECNOLOGICO JAIRO S.A</strong> </h5>
                                            <h6>Matricula 2022</h6>
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
                                        <td><strong> {{ $matricula->prematricula->nombre }}</strong></td>
                                        <td>Cédula: </td>
                                        <td><strong>{{ $matricula->prematricula->cedula }}</strong></td>
                                    </tr>
                                    <tr>
                                        <td>Fecha de nacimiento: </td>
                                        <td><strong> {{ $matricula->prematricula->fecha_nac }}</strong></td>
                                        <td>Teléfono: </td>
                                        <td><strong>{{ $matricula->prematricula->tel }}</strong></td>
                                    </tr>
                                    <tr>
                                        <td>Nombre de la Madre: </td>
                                        <td><strong> {{ $matricula->prematricula->madre }}</strong></td>
                                        <td>Nombre del Padre: </td>
                                        <td><strong>{{ $matricula->prematricula->padre }}</strong></td>
                                    </tr>
                                    <tr>
                                        <td>Fecha de prematrícula: </td>
                                        <td><strong>{{ $matricula->prematricula->fecha_prematricula }}</strong></td>
                                        <td>Fecha de matricula: </td>
                                        <td><strong>{{ $matricula->fecha_matricula }}</strong></td>
                                    </tr>
                                    <tr>
                                        <td colspan="4">
                                            <br>
                                            <h6>Datos del centro</h6>
                                            <hr>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Nombre: </td>
                                        <td><strong>INTITUTO TECNOLOGICO JAIRO S.A</strong></td>
                                        <td>Dirección: </td>
                                        <td><strong>ERMITA SAN PEDRO 3 1/2 C AL SUR</strong></td>
                                    </tr>
                                    <tr>
                                        <td>Director: </td>
                                        <td><strong>CARLOS ANTONIO RIVAS HERNANDEZ</strong></td>
                                        <td>Teléfono: </td>
                                        <td><strong>23118965</strong></td>
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
