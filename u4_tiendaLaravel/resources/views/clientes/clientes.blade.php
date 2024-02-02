@extends('plantilla/plantilla')
@section('titulo', 'CLIENTES')
@section('mensaje')
    <h3 class="text-danger">Espacio para mensaje</h3>
@endsection
@section('contenido')
    {{-- <form action="{{ route('crearCliente') }}" method="GET" class="d-flex justify-content-center">
        <button type="submit" class="btn btn-info">Crear Cliente</button>
    </form> --}}
    <table class="table">
        <thead class="table-dark">
            <tr>
                <th scope="col">Id</th>
                <th scope="col">Email</th>
                <th scope="col">Teléfono</th>
                <th scope="col">Dirección</th>
                <th scope="col">Teléfono</th>
                <th scope="col">Email</th>
                <th scope="col">Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($clientes as $c)
                <tr>
                    <th scope="row">{{ $c->id }}</th>
                    <td>{{ $c->email }}</td>
                    <td>{{ $c->telefono }}</td>
                    <td>{{ $c->direccion }}</td>
                    <td>{{ $c->telefono }}</td>
                    <td>{{ $c->usuario->email }}</td>
                    <td>
                        <a class="btn btn-success" href="{{ route('modificarC', $c->id) }}">Modificar</a>
                        <form action="{{ route('borrarC', $c->id) }}" method="POST">
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
