<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>

<body>
    <h1>FACTURAS</h1>
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

        <label for="producto">Producto</label>
        <select name="producto" id="producto">
            @foreach ($productos as $p)
                @if (old('producto') != null and old('producto') == $p->id)
                    <option value="{{ $p->id }}" selected="selected">{{ $p->nombreProducto }}</option>
                @else
                    <option value="{{ $p->id }}">{{ $p->nombreProducto }}</option>
                @endif
            @endforeach
        </select>
        @error('producto')
            <div>
                Rellena Producto
            </div>
        @enderror

        <label for="cantidad">Cantidad</label>
        <input type="text" name="cantidad" value="{{ old('cantidad') }}">
        @error('cantidad')
            <div>
                Rellena Cantidad
            </div>
        @enderror

        <button type="submit">Crear</button>
        <button type="reset">Limpiar</button>
        <a href="{{ route('rutaVer') }}">Cancelar</a>
    </form>
    <div style="color:red">
        @if (session('mensaje') != null)
            {{ session('mensaje') }}
        @endif
    </div>
</body>

</html>
