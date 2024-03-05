<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>

<body>
    <h1>VIAJES</h1>
    <a href="{{ route('rutaCrear') }}">+Nuevo</a>
    <table>
        <tr>
            <th>Id</th>
            <th>Titulo-del-Viaje</th>
            <th>Destino</th>
            <th>Nº-noches</th>
            <th>Nº-de-Plazas</th>
            <th>Precio</th>
        </tr>
        @foreach ($viajes as $v)
            <tr>
                <td>{{ $v->id }}</td>
                <td>{{ $v->tituloV }}</td>
                <td>{{ $v->destino }}</td>
                <td>{{ $v->nNoches }}</td>
                <td>{{ $v->nPlazas }}</td>
                <td>{{ $v->pPersona }}</td>
            </tr>
        @endforeach
    </table>
</body>

</html>
