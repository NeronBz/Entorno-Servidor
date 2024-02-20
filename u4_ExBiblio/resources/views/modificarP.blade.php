<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <h1>MODIFICAR PRÉSTAMO</h1>
    <form action="{{route('rutaActualizar', $p->id)}}" method="POST">
    @csrf
    <label for="Id">Id</label>
    <input type="number" name="id" disabled="disabled" value="{{$p->id}}">
    <label for="fecha">Fecha</label>
    <input type="date" name="fecha" value="{{$p->fecha}}">
    @error('fecha')
        <div>
            Rellena Fecha
        </div>
    @enderror

    <label for="libro">Libro</label>
    <select name="libro" id="libro">
        @foreach ($libros as $l)
        @if($p->libro_id==$l->id)
        <option value="{{$l->id}}" selected="selected">{{$l->titulo}}</option>
        @else
        <option value="{{$l->id}}">{{$l->titulo}}</option>
        @endif
        @endforeach
    </select>
    @error('libro')
        <div>
            Rellena Libro
        </div>
    @enderror

    <label for="cliente">Cliente</label>
    <input type="text" name="cliente" value="{{$p->nombreCliente}}">
    @error('cliente')
        <div>
            Rellena Cliente
        </div>
    @enderror

        <label for="fechaD">Fecha Devolución</label>
    <input type="date" name="fechaD" value="{{$p->fechaDevolucion}}">

    <button type="submit">Modificar</button>
    <a href="{{route('rutaVer')}}">Cancelar</a>
</form>
<div style="color:red">
    @if(session('mensaje')!=null)
{{session('mensaje')}}
    @endif
</div>
</body>
</html>