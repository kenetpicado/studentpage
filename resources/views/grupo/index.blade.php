@extends('layout')

@section('title', 'Grupos')

@section('content')
    <div class="container-fluid">

        <!-- Content Row -->
        <div class="row">
            <div class="col-xl-12 col-lg-7">

                <!-- Datos -->
                <div class="card shadow mb-4">
                    <!-- Card Header - Dropdown -->
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary">VER GRUPOS</h6>
                        <div class="dropdown no-arrow">
                            <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown"
                                aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in"
                                aria-labelledby="dropdownMenuLink">
                                <a class="dropdown-item" href="{{ route('grupo.create') }}">Crear grupo</a>
                                
                            </div>
                        </div>
                    </div>

                    <div class="card-body">
                        <div class="alert alert-primary" role="alert">
                            {{$status ?? ''}}. Haga clic aqui para <a href="{{ route('grupo.create') }}">crear un nuevo grupo.</a>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-striped" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Curso</th>
                                        <th>Grupo</th>
                                        <th>Docente a cargo</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($grupos as $grupo)
                                        <tr>
                                            <td>{{ $grupo->id }}</td>
                                            <td>{{ $grupo->curso->nombre ?? ''}}</td>
                                            <td>{{ $grupo->numero }}</td>
                                            <td>{{ $grupo->docente->nombre }}</td>
                                            <td>
                                                <div class="dropdown no-arrow">
                                                    <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink"
                                                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                        {{-- <i class="fas fa-exclamation-circle fa-sm fa-fw text-gray-400"></i> --}}
                                                        Ver opciones <i class="fas fa-cog"></i>
                                                    </a>
                                                    <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in"
                                                        aria-labelledby="dropdownMenuLink">
                                                        
                                                        <form class="dropdown-item"
                                                            action="{{route('grupo.alumnos', $grupo)}}" method="get">
                                                            <input type="submit" class="dropdown-item"
                                                                value="Ver alumnos">
                                                        </form>
                                                        <form class="dropdown-item"
                                                            action="{{route('grupo.edit', $grupo)}}" method="get">
                                                            <input type="submit" class="dropdown-item"
                                                                value="Cambiar docente">
                                                        </form>

                                                        {{-- SI NO TIENE RELACION CON ALGUMATRICULA SE MUESTRA ELIMINAR --}}
                                                        @if (count($grupo->matriculas) == 0)
                                                            <form class="dropdown-item eliminar"
                                                                action="{{ route('grupo.destroy', $grupo->id) }}"
                                                                method="POST">
                                                                @csrf
                                                                @method('DELETE')
                                                                <input type="submit" class="dropdown-item"
                                                                    value="Eliminar grupo">
                                                            </form>
                                                        @endif
                                                    </div>
                                                </div>
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
        <!-- Content Row -->
    </div>
@endsection('content')
