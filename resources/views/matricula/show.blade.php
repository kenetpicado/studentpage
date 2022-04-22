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
                        <h6 class="m-0 font-weight-bold text-primary">DATOS DE LA MATRICULA</h6>
                    </div>

                    <div class="card-body" id="imprimible">
                        <div class="row">
                            <div class="form-group col-lg-12">
                                <table class="table table-borderless">
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
                                        <td><strong>{{$matricula->created_at}}</strong></td>
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
