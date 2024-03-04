<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>

<body>
    <h1>MODIFICAR FACTURA</h1>
    <form action="{{ route('rutaActualizar', $v->id) }}" method="POST">
        @csrf
        <label for="Id">Id</label>
        <input type="number" name="id" readonly value="{{ $v->id }}">

        <label for="fecha">Fecha</label>
        <input type="date" name="fecha" readonly value="{{ $v->fecha }}">

        <label for="producto">Producto</label>
        <select name="producto" id="producto">
            @foreach ($productos as $p)
                @if ($v->producto_id == $p->id)
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
        <input type="number" name="cantidad" value="{{ $p->cantidad }}">
        @error('cantidad')
            <div>
                Rellena Cantidad
            </div>
        @enderror

        <button type="submit">Modificar</button>
        <a href="{{ route('rutaVer') }}">Cancelar</a>
    </form>
    <div style="color:red">
        @if (session('mensaje') != null)
            {{ session('mensaje') }}
        @endif
    </div>
</body>

</html>
