@extends('layout')

@section('title', 'Editar matrícula')

@section('content')
    <div class="container-fluid">

        <!-- Content Row -->
        <div class="row">
            <form class="col-xl-12 col-lg-7" action="{{ route('matricula.update', $matricula->id) }}" method="POST">
                @csrf
                @method('PUT')
                <!-- Datos-->
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">EDITAR MATRICULA</h6>
                    </div>

                    <div class="card-body">
                        <div class="row">
                            <div class="form-group col-lg-6">
                                <table class="table table-striped">
                                    <tr>
                                        <td>Nombre:</td>
                                        <td><strong> {{ $matricula->prematricula->nombre }}</strong></td>
                                    </tr>
                                    <tr>
                                        <td>Carnet:</td>
                                        <td><strong> {{ $matricula->carnet }}</strong></td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <label for="manual">Manual de usuario</label>
                                        </td>
                                        <td>
                                            <select name="manual" class="form-control">
                                                @if ($matricula->manual == 'NO')
                                                    <option selected value="NO">NO</option>
                                                    <option value="SI">SI</option>
                                                @else
                                                    <option value="NO">NO</option>
                                                    <option selected value="SI">SI</option>
                                                @endif
                                            </select>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                        
                        <button type="submit" class="btn btn-primary">Guardar</button>
                    </div>
                </div>
            </form>
        </div>
        <!-- Content Row -->

    </div>
@endsection('content')
