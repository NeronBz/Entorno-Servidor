@extends('plantilla/plantilla')
@section('titulo', 'CREAR CLIENTES')
@section('contenido')
    <form action="{{ route('insertarCliente') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label for="id" class="form-label">Id</label>
            <input type="text" id="id" name="id" class="form-control" placeholder="Id">
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="text" id="email" name="email" class="form-control" placeholder="Email">
        </div>
        <div class="mb-3">
            <label for="telefono" class="form-label">Teléfono</label>
            <input type="text" id="telefono" name="telefono" class="form-control">
        </div>
        <div class="mb-3">
            <label for="direccion" class="form-label">Dirección</label>
            <input type="text" id="direccion" name="direccion" class="form-control">
        </div>
        <div class="mb-3">
            <button type="submit" class="btn btn-success">Crear Cliente</button>
            <a href="{{ route('clientes') }}" class="btn btn-danger">Cancelar</a>
        </div>
    </form>
@endsection
