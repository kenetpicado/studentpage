@extends('layout')

@section('title', 'Caja')

@section('bread')
    <li class="breadcrumb-item active" aria-current="page">Caja</li>
@endsection

@section('content')
    <x-header-0>Caja</x-header-0>

    <div class="card-body">
        <div class="row justify-content-center mb-4">
            <div class="col-lg-6">
                <form class="d-flex" method="POST" action="{{ route('caja.buscar') }}">
                    @csrf
                    <input class="form-control me-2  @error('buscar') is-invalid @enderror" type="search"
                        placeholder="Ingrese el carnet o nombre" name="buscar">
                    <button class="btn btn-primary" type="submit">Buscar</button>
                </form>
            </div>
        </div>

        <table class="table table-borderless aligh-middle" id="dataTable" width="100%" cellspacing="0">
            <thead>
                <tr class="text-primary text-uppercase small">
                    <th>NOMBRE</th>
                    <th>CARNET</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @if (session('matriculas') && count(session('matriculas')) > 0)
                    @foreach (session('matriculas') as $matricula)
                        <tr>
                            <td>{{ $matricula->nombre }}</td>
                            <td>{{ $matricula->carnet }}</td>
                            <td>
                                <a href="{{ route('pagos.index', $matricula->id) }}">Realizar pago</a>
                            </td>
                        </tr>
                    @endforeach
                @endif
            </tbody>
        </table>
    </div>
@endsection
