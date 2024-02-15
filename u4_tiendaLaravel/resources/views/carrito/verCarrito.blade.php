@extends('plantilla/plantilla')
@section('titulo', 'CARRITO')

@section('contenido')
    <table class="table">
        <thead class="table-dark">
            <tr>
                <th scope="col">Id</th>
                <th scope="col">Nombre</th>
                <th scope="col">Descripción</th>
                <th scope="col">Precio</th>
                <th scope="col">Cantidad</th>
                <th scope="col">Foto</th>
                <th scope="col">Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach (session('carrito') as $pc)
                <tr>
                    <form action="{{ route('modificarCarrito') }}" method="POST">
                        @csrf
                    <th scope="row">{{ $pc['producto']->id }}</th>
                    <td>{{ $pc['producto']->nombre }}</td>
                    <td>{{ $pc['producto']->descripcion }}</td>
                    <td>{{ $pc['producto']->precio }}</td>
                    <td><input type="number" name="cantidad" value="{{$pc['cantidad']}}">{{ $pc['cantidad'] }}</td>
                    <td><img src="{{ asset('storage/' . $pc['producto']->img) }}" width="100px"></td>
                    <td>
                        <button type="submit" class="btn btn-success"
                        name="modificarPC" value="{{$pc['producto']->id}}">Modificar</button>
                        <button type="submit" class="btn btn-success"
                        name="borrarPC" value="{{$pc['producto']->id}}">Borrar</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <form action="{{route('crearPedido')}}" method="POST">
        @csrf
    <button type="submit" class="btn btn-outline-success" value="">Crear Pedido</button>
</form>
@endsection
