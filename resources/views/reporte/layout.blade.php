<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/x-icon" href="{{ asset('img/SP.png') }}">
    <title>Reporte - @yield('title')</title>
    <link href="{{ asset('css/app2.css') }}" rel="stylesheet">

    <style>
        @media print {

            .ocultar,
            .ocultar * {
                display: none !important;
            }
        }

        table {
            page-break-inside: auto
        }

        tr {
            page-break-inside: avoid;
            page-break-after: auto
        }
    </style>
</head>

<body>
    <div class="card border-0">
        <div class="card-body">
            @yield('content')
        </div>
    </div>
    <p class="text-center">
        <a href="javascript:window.print()" class="btn btn-primary ocultar float-center">
            Imprimir
        </a>
    </p>
</body>

</html>
