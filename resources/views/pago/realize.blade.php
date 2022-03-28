@extends('layout')

@section('title', 'Matricular')

@section('content')
    <div class="container-fluid">
        <!-- Content Row -->
        <div class="row">
            <form class="col-12" action="{{ route('pago.store') }}" method="POST">
                @csrf
                <!-- Datos de la matricula-->
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">EFECTUAR PAGO</h6>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="form-group col-6">
                                <label for="matricula_id">ID Matricula</label>
                                <input type="text" class="form-control is-valid" name="matricula_id" autocomplete="off"
                                    value="{{ $matricula->id }}" readonly>
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group col-6">
                                <label for="carnet">Carnet</label>
                                <input type="text" class="form-control is-valid" name="carnet" autocomplete="off"
                                    value="{{ $matricula->carnet }}" readonly>
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group col-6">
                                <label for="monto">Monto a pagar (C$)</label>
                                <input type="number" class="form-control @error('monto') is-invalid @enderror" name="monto"
                                    autocomplete="off" value="{{ old('monto') }}">
                                
                                    @error('monto')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group col-6">
                                <label for="concepto">Concepto</label>
                                <input type="text" class="form-control @error('concepto') is-invalid @enderror" name="concepto"
                                    autocomplete="off" value="{{ old('concepto') }}">
                                
                                    @error('concepto')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
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
