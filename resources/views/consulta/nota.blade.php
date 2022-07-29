@extends('layout')

@section('title', 'Notas')

@section('bread')
    <li class="breadcrumb-item active" aria-current="page">Notas</li>
@endsection

@section('content')
    <x-header-0>Notas</x-header-0>
    <div class="card-body">
        <div class="row justify-content-center mb-4">
            <div class="col-lg-6">
                @if (count($notas) > 0)
                    <div class="table-responsive">
                        <table class="table table-borderless" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>Modulo</th>
                                    <th>Nota</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($notas as $nota)
                                    <tr>
                                        <td>{{ $nota->modulo }}</td>
                                        <td>{{ $nota->valor }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <div class="alert alert-primary" role="alert">
                        No se han registrado
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
