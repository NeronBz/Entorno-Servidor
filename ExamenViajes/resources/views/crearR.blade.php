<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>

<body>
    <h1>CREAR RESERVA</h1>
    <form action="{{ route('rutaInsertar') }}" method="POST">
        @csrf
        <label for="viaje">Viaje</label>
        <select name="viaje" id="viaje">
            @foreach ($viajes as $v)
                @if (old('viaje') != null and old('viaje') == $v->id)
                    <option value="{{ $v->id }}" selected="selected">{{ $v->tituloV }}</option>
                @else
                    <option value="{{ $v->id }}">{{ $v->tituloV }}</option>
                @endif
            @endforeach
        </select>
        @error('viaje')
            <div>
                Rellena Viaje
            </div>
        @enderror

        <label for="fecha">Fecha</label>
        @if (old('fecha') != null)
            <input type="date" name="fecha" value="{{ old('fecha') }}">
        @else
            <input type="date" name="fecha" value="{{ date('Y-m-d') }}">
        @endif
        @error('fecha')
            <div>
                Rellena Fecha
            </div>
        @enderror

        <label for="nombre">Cliente</label>
        <input type="text" name="nombre">
        @error('nombre')
            <div>
                Rellena Nombre
            </div>
        @enderror
        <label for="nPersonas">Nº Personas</label>
        <input type="number" name="nPersonas">
        @error('nPersonas')
            <div>
                Rellena Nº de Personas
            </div>
        @enderror

        <button type="submit">Crear</button>
        <a href="{{ route('rutaVer') }}">Cancelar</a>
    </form>
    <div style="color:red">
        @if (session('mensaje') != null)
            {{ session('mensaje') }}
        @endif
    </div>
</body>

</html>
