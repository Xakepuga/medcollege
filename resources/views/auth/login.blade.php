<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'АИС «Приёмная комиссия»') }} | Войти</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <!-- Favicon -->
    <link rel="shortcut icon" type="image/png" href="{{ asset('favicon.png') }}">

    <!-- Scripts -->
    @vite(['resources/js/app.js'])
    <style>
        .custom-st-border-radius {
            border-radius: 15px;
        }

        .custom-st-background-color {
            background-color: #41A49E;
        }

        .custom-st-letter-spacing {
            letter-spacing: 0.02em;
        }
    </style>
</head>
<body class="bg-secondary bg-opacity-10">
<div id="app" class="custom-st-wrapper">
    <main class="container row justify-content-center align-items-center custom-st-main mx-auto p-0">
        <div class="row justify-content-center p-0">
            <div class="col-lg-4">
                <div class="card custom-st-background-color border border-5 border-white custom-st-border-radius shadow-lg">
                    <img src="/img/aispk-logo.svg" class="card-img-top mt-5" alt="logo" width="168px" height="179px">
                    <div class="card-body">
                        <div class="text-center mt-4 mb-3">
                            <h3 class="card-title text-white fw-bold custom-st-letter-spacing m-0">АИС</h3>
                            <h3 class="card-title text-white fw-bold custom-st-letter-spacing m-0">"Приёмная
                                комиссия"</h3>
                        </div>
                        <form action="{{ route('login') }}"
                              method="POST"
                              class="p-2">
                            @csrf
                            <label for="email" class="form-label"></label>
                            <input id="email"
                                   class="form-control shadow bg-body @error('email') is-invalid @enderror"
                                   name="email"
                                   value="{{ old('email') }}"
                                   type="email"
                                   required
                                   autofocus
                                   placeholder="Имя пользователя" style="min-height: 40px">
                            <label for="password" class="form-label"></label>
                            <input id="password"
                                   class="form-control shadow bg-body @error('password') is-invalid @enderror"
                                   name="password"
                                   type="password"
                                   required
                                   placeholder="Пароль" style="min-height: 40px">
                            @error('password')
                            <span class="invalid-feedback fs-6 bg-danger text-white rounded-1 mt-3 p-1"
                                  role="alert">{{ $message }}</span>
                            @enderror
                            @error('email')
                            <span class="invalid-feedback fs-6 bg-danger text-white rounded-1 mt-3 p-1"
                                  role="alert">{{ $message }}</span>
                            @enderror
                            <div class="d-grid gap-2 d-lg-block text-center mt-5 mb-3">
                                <button class="btn btn-light shadow bg-body px-lg-5 py-2">Войти</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </main>
</div>
</body>
</html>
