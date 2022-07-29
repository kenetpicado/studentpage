@extends('layout')

@section('title', 'Caja')

@section('bread')
    <li class="breadcrumb-item active" aria-current="page">Caja</li>
@endsection

@section('content')
    <x-header-0>Caja</x-header-0>

    <div class="row justify-content-center mb-4">
        <div class="col-lg-6">
            <div class="card-body">
                <form class="d-flex" method="POST" action="{{ route('caja.buscar') }}">
                    @csrf
                    <input class="form-control me-2  @error('carnet') is-invalid @enderror" type="search"
                        placeholder="Ingrese el carnet" name="carnet">
                    <button class="btn btn-primary" type="submit">Buscar</button>
                </form>
            </div>
            <div class="card-body">
                @if (session('matriculas') && count(session('matriculas')) > 0)
                    @foreach (session('matriculas') as $matricula)
                        <div class="alert alert-primary" role="alert">
                            <a class="btn btn-sm btn-primary" href="{{ route('pagos.index', $matricula->id) }}">Pagar</a>
                            {{ $matricula->carnet }} - {{ $matricula->nombre }}
                            
                        </div>
                    @endforeach
                @else
                    <div class="alert alert-danger" role="alert">
                        No hay datos para mostrar
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
