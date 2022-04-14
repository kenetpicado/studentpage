@extends('layout')

@section('title', 'Promotores')

@section('content')
    <div class="container-fluid">

        <!-- Cabecera -->
        <div class="d-sm-flex align-items-center justify-content-between m-2">
            <h1 class="h3 mb-0 text-gray-800">Promotores</h1>
            <button type="button" class="btn btn-sm btn-primary ml-2" data-toggle="modal" data-target="#promotorModalCreate">
                Agregar <i class="fas fa-plus ml-1"></i>
            </button>
        </div>

        <!-- Content Row -->
        <div class="row">
            <div class="col-xl-12 col-lg-7">

                <!-- Datos  -->
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">TODOS LOS PROMOTORES</h6>
                    </div>

                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Nombre</th>
                                        <th>Correo</th>
                                        <th>Sucursal</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($promotors as $promotor)
                                    <tr>
                                            <td>{{ $promotor->carnet }}</td>
                                            <td>{{ $promotor->nombre }}</td>
                                            <td>{{ $promotor->correo }}</td>
                                            <td>{{ $promotor->sucursal }}</td>
                                            <td>
                                                <a href="{{ route('promotor.edit', $promotor->id) }}"><i class="fas fa-tasks"></i></a>
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

@section('agregarModal')
    @include('promotor.modal')
@endsection

@section('re-open')
    @if ($errors->any())
        <script>
            $('#promotorModalCreate').modal('show')
        </script>
    @endif
@endsection
