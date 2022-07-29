<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/x-icon" href="{{ asset('img/SP.png') }}">
    <title>{{ config('app.name') }} | @yield('title')</title>

    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css" rel="stylesheet">
    <link href="{{ asset('css/app2.css') }}" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{ asset('DataTables/datatables.min.css') }}" />
</head>

<body class="bg-light">
    @include('partials.topbar')

    <div class="container">
        <div class="justify-content-center">

            <nav aria-label="breadcrumb" class="bg-secondary bg-opacity-10 rounded-3">
                <ol class="breadcrumb p-2">
                    <li class="breadcrumb-item"><a href="{{ route('index') }}">Inicio</a></li>
                    @yield('bread')
                </ol>
            </nav>

            @if (session('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            @if (session('success'))
                <div class="alert alert-primary alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <div class="card mb-4 ">
                @yield('content')
            </div>
        </div>
    </div>
    

    <script src="{{ asset('js/app.js') }}"></script>
    <script type="text/javascript" src="{{ asset('DataTables/datatables.min.js') }}"></script>

    @if ($errors->any())
        <script>
            $(document).ready(function() {
                $("#agregar").modal('show');
            });
        </script>
    @endif

    <script>
        $(document).ready(function() {
            $('#dataTable').DataTable({
                "ordering": false,
                responsive: true,
                "pageLength": 50,
            });
        });
    </script>
</body>

</html>
