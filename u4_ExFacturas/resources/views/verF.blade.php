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
    <a href="{{ route('rutaCrear') }}">+Nuevo</a>
    <table>
        <tr>
            <th>Id</th>
            <th>Fecha-Factura</th>
            <th>Producto</th>
            <th>Cantidad</th>
            <th>Precio-Unitario</th>
            <th>Total</th>
            <th>Acciones</th>
        </tr>
        @foreach ($ventas as $v)
            <tr>
                <td>{{ $v->id }}</td>
                <td>{{ date('d/m/Y', strtotime($v->fecha)) }}</td>
                <td>{{ $v->producto->nombreProducto }}</td>
                <td>{{ $v->cantidad }}</td>
                <td>{{ $v->precioUnitario }}</td>
                <td>{{ $v->precioUnitario * $v->cantidad }}</td>
                <td><a href="{{ route('rutaModificar', $v->id) }}">Modificar</a></td>
            </tr>
        @endforeach
    </table>
</body>

</html>
