@extends('layout')

@section('title', 'Registrar pago')

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

                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">REGISTRAR PAGO</h6>
                    </div>

                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>N°</th>
                                        <th>Carnet</th>
                                        <th>Opción</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($matriculas as $matricula)
                                        <tr class="center-babe">
                                            <td>{{ $matricula->id }}</td>
                                            <td>
                                                <div class="card bg-success text-white shadow">
                                                    <div class="card-body p-2">
                                                        {{ $matricula->carnet }}
                                                    </div>
                                                    
                                                </div>
                                                
                                            </td>
                                            <td><a href="{{ route('pagar', $matricula->id) }}"
                                                    class="btn btn-primary">Registrar pago</a></td>
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
