@extends('plantilla/plantilla')
@section('titulo', 'PRODUCTOS')
@section('mensaje')
    <h3 class="text-danger">Espacio para mensaje</h3>
@endsection
@section('contenido')
    <form action="{{ route('crearProducto') }}" method="GET" class="d-flex justify-content-center">
        <button type="submit" class="btn btn-info">Crear Producto</button>
    </form>
    <table class="table">
        <thead class="table-dark">
            <tr>
                <th scope="col">Id</th>
                <th scope="col">Nombre</th>
                <th scope="col">Descripción</th>
                <th scope="col">Precio</th>
                <th scope="col">Stock</th>
                <th scope="col">Foto</th>
                <th scope="col">Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($productos as $p)
                <tr>
                    <th scope="row">{{ $p->id }}</th>
                    <td>{{ $p->nombre }}</td>
                    <td>{{ $p->descripcion }}</td>
                    <td>{{ $p->precio }}</td>
                    <td>{{ $p->stock }}</td>
                    <td><img src="{{ asset('storage/' . $p->img) }}" width="100px"></td>
                    <td>
                        <a class="btn btn-success" href="{{ route('modificarP', $p->id) }}">Modificar</a>
                        <form action="{{ route('borrarP', $p->id) }}" method="POST">
                            @method('DELETE')
                            @csrf
                            <button type="submit" class="btn btn-danger">Borrar</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
