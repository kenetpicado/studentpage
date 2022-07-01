@extends('consulta.layout')

@section('title', 'Notas')

@section('content')
    <h1 class="h4 text-gray-900 mb-4">Notas</h1>

    @if (count($notas) > 0)
        <div class="table-responsive">
            <table class="table table-borderless" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>Materia</th>
                        <th>Nota</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($notas as $nota)
                        <tr>
                            <td>{{ $nota->materia }}</td>
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

    <a href="{{ route('consulta.index') }}" class="btn btn-primary float-right">Regresar</a>
@endsection
