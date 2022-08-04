<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/x-icon" href="{{ asset('img/SP.png') }}">
    <title>Reporte de notas - {{ $grupo->curso_nombre }}</title>

    <link href="{{ asset('css/app2.css') }}" rel="stylesheet">
</head>

<body>
    <div class="card" id="seleccion">
        <x-header-0>Reporte de notas: {{ $grupo->curso_nombre }}</x-header-0>

        <div class="card-body">

            <table class="table table-borderless table-sm" width="100%" cellspacing="0">
                <tr>
                    <td>Docente: {{ $grupo->docente_nombre }}</td>
                    <td>Horario: {{ $grupo->horario }} </td>
                    <td>
                        @if ($grupo->sucursal == 'CH')
                            <p>Sucusal: Chinandega </p>
                        @else
                            <p>Sucusal: Managua </p>
                        @endif
                    </td>
                    <td>Fecha: {{ date('d-m-Y') }} </td>
                </tr>
            </table>
            <table class="table table-borderless table-sm" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>Carnet</th>
                        <th>Nombre</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($inscripciones as $inscripcion)
                        <tr>
                            <td>{{ $inscripcion->matricula_carnet }}</td>
                            <td>{{ $inscripcion->matricula_nombre }}</td>

                            @foreach ($inscripcion->notas as $nota)
                                <td>
                                    <div class="small">{{ $nota->mod }}: {{ $nota->valor }}</div>
                                </td>
                            @endforeach
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <input type="button" class="btn btn-primary my-2" onclick="printDiv('seleccion');" value="Imprimir" />

    <script>
        function printDiv(nombreDiv) {
            var contenido = document.getElementById(nombreDiv).innerHTML;
            var contenidoOriginal = document.body.innerHTML;
            document.body.innerHTML = contenido;
            window.print();
            document.body.innerHTML = contenidoOriginal;
        }
    </script>
</body>

</html>
