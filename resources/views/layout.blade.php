<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/x-icon" href="{{ asset('img/SP.png') }}">
    <title>{{ config('app.name') }} - @yield('title')</title>
    <link href="{{ asset('css/app.min.css') }}" rel="stylesheet">

    <style>
        @media only screen and (max-width:800px) {

            #no-more-tables tbody,
            #no-more-tables tr,
            #no-more-tables td {
                display: block;
            }

            #no-more-tables thead tr {
                position: absolute;
                top: -9999px;
                left: -9999px;
            }

            #no-more-tables td {
                position: relative;
                padding-left: 25%;
                border: none;
                border-bottom: 1px solid #fff;
            }

            #no-more-tables td:before {
                content: attr(data-title);
                position: absolute;
                left: 4px;
                font-weight: bold;
            }

            #no-more-tables tr {
                border-bottom: 1px solid #aaaa;
            }
        }

        .btn {
            width: 150px;
        }

        .btn-sm {
            width: 80px;
        }
    </style>
</head>

<body class="bg-light">
    @include('partials.topbar')

    <div class="container">
        <div class="justify-content-center">
            <nav aria-label="breadcrumb" class="rounded-3">
                <ol class="breadcrumb">
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

            <div class="card pb-5 mb-5">
                @yield('content')
            </div>
        </div>
    </div>

    <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('js/sp.js') }}"></script>

    @if ($errors->any())
        <script>
            $(document).ready(function() {
                $("#modalCreate").modal('show');
            });
        </script>
    @endif
</body>

</html>
