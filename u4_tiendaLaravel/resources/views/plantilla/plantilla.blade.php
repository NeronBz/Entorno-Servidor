<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-
            rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65"
        crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous">
    </script>

</head>

<body>
    <header>
        <div style="display:flex; justify-content:space-between">
            <div style="display:flex; align-items:center"> 
                <img src="{{ asset('img/logo.jpg') }}" alt="" style="width: 20%">
            </div>
           <div style="display:flex; align-items:center">
            <h3>{{Auth::user()->name}}</h3>
            <a href="{{route('salir')}}" class="btn btn-outline-success">Salir</a>
           </div>
        
        </div>
        <h1 class="text-center">@yield('titulo')</h1>
        <nav class="navbar navbar-expand-lg navbar-light bg-light justify-content-center">
            <a class="navbar-brand" href="{{ route('productos') }}">Productos</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <a class="navbar-brand" href="{{ route('pedidos') }}">Pedidos</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            @if (Auth::user()->tipo=='A')
            <a class="navbar-brand" href="{{ route('clientes') }}">Clientes</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            @endif
        </nav>
    </header>
    <section>
        <div class="container d-flex justify-content-center">
            {{-- Comprobar si hay mensaje en la variable de sesión --}}
            @if (session('mensaje'))
                <h3 class="text-danger">{{ session('mensaje') }}</h3>
            @endif
        </div>
    </section>
    <section>
        <div class="container">
            @yield('contenido')
        </div>
    </section>
</body>

</html>
