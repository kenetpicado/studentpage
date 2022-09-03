<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/x-icon" href="{{ asset('img/SP.png') }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name') }} - Login</title>
    <link href="css/app2.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css" rel="stylesheet">
</head>

<body class="bg-light">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-6">

                <div class="card o-hidden border-1 my-5 shadow">
                    <div class="card-body p-0">
                        <div class="p-5">
                            <div class="text-center">
                                <img src="{{ asset('img/SP.png') }}" alt="" srcset="" width="25%" height="auto">
                            </div>
                            <form method="POST" action="{{ route('login') }}">
                                @csrf
                                <x-input name="email" label="ID"></x-input>

                                <div class="mb-3">
                                    <label class="form-label">PIN</label>

                                    <div class="input-group">
                                        <input type="password"
                                            class="form-control @error('password') is-invalid @enderror"
                                            id="input_password" name="password">
                                        <button type="button" class="input-group-text" id="show_password"><i
                                                class="fa fa-eye"></i></button>
                                    </div>
                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="form-check mb-3">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember"
                                        {{ old('remember') ? 'checked' : '' }}>
                                    <label class="form-check-label" for="remember">Recordarme</label>
                                </div>
                                <div class="d-grid">
                                    <button type="submit" class="btn btn-primary">Login</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        var password = document.getElementById("show_password");
        password.onclick = function() {
            $input = document.getElementById("input_password");
            $input.type == "text" ? $input.type = "password" : $input.type = "text";
        }
    </script>
</body>

</html>
