@extends('layout')

@section('title', 'Notas')

@section('content')
    <div class="container-fluid">

        <!-- Cabecera -->
        <div class="d-sm-flex align-items-center justify-content-between m-2">
            <h1 class="h3 mb-0 text-gray-800">Notas</h1>
            <button type="button" class="btn btn-sm btn-primary ml-2" data-toggle="modal" data-target="#agregar">
                Agregar <i class="fas fa-plus ml-1"></i>
            </button>
        </div>

        <!-- Content Row -->
        <div class="row">
            <form class="col-xl-12 col-lg-7">

                <!-- Datos de los pagos -->
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">{{ $matricula->nombre }}</h6>
                    </div>

                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>Fecha</th>
                                        <th>Unidad</th>
                                        <th>Nota</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($notas as $nota)
                                        <tr>
                                            <td>{{ $nota->created_at }}</td>
                                            <td>{{ $nota->unidad }}</td>
                                            <td>{{ $nota->valor }}</td> 
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

@section('agregarModal')
    @include('nota.modal')
@endsection

@section('re-open')
    @if ($errors->any())
        <script>
            $('#agregar').modal('show')
        </script>
    @endif
@endsection
