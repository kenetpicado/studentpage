<!DOCTYPE html>
<html lang="es">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name') }} - Registrar</title>
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
</head>

<body class="bg-primary">

    <div class="container ">

        <!-- Outer Row -->
        <div class="row justify-content-center">

            <div class="col-lg-6">

                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <div class="p-5">
                            <div class="text-center">
                                <h1 class="h4 text-gray-900 mb-4">{{ config('app.name') }}</h1>
                                <h1 class="h6 text-gray-900 mb-4">Crear cuenta de Administrador</h1>

                            </div>
                            <form method="POST" action="{{ route('register') }}">
                                @csrf

                                <div class="form-group">
                                    <label for="">Nombre</label>
                                    <input type="text" class="form-control @error('name') is-invalid @enderror"
                                        autocomplete="off" name="name" value="{{ old('name') }}">
                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="correo">Correo</label>
                                    <input type="email" class="form-control @error('correo') is-invalid @enderror" name="correo"
                                        autocomplete="off" value="{{ old('correo') }}">
            
                                    @error('correo')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="sucursal">Sucursal</label>
                                    <select name="sucursal" class="form-control">
                                        <option value="CH"  {{ old('sucursal') == 'CH' ? 'selected' : '' }}>CHINANDEGA</option>
                                        <option value="MG" {{ old('sucursal') == 'MG' ? 'selected' : '' }}>MANAGUA</option>
                                        <option value="AD" {{ old('sucursal') == 'AD' ? 'selected' : '' }}>GLOBAL</option>
                                    </select>
                                </div>
                                <button type="submit" class="btn btn-primary btn-user btn-block">Crear cuenta</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
