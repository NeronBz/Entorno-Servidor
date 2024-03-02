<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>

<body>
    <h1>PRÉSTAMOS</h1>
    <form action="{{ route('rutaInsertar') }}" method="POST">
        @csrf
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

        <label for="libro">Libro</label>
        <select name="libro" id="libro">
            @foreach ($libros as $l)
                @if (old('libro') != null and old('libro') == $l->id)
                    <option value="{{ $l->id }}" selected="selected">{{ $l->titulo }}</option>
                @else
                    <option value="{{ $l->id }}">{{ $l->titulo }}</option>
                @endif
            @endforeach
        </select>
        @error('libro')
            <div>
                Rellena Libro
            </div>
        @enderror

        <label for="cliente">Cliente</label>
        <input type="text" name="cliente" value="{{ old('cliente') }}">
        @error('cliente')
            <div>
                Rellena Cliente
            </div>
        @enderror

        <button type="submit">Crear</button>
        <button type="reset">Limpiar</button>
    </form>
    <div style="color:red">
        @if (session('mensaje') != null)
            {{ session('mensaje') }}
        @endif
    </div>
</body>

</html>
