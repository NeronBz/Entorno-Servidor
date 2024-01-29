@extends('plantilla/plantilla')
@section('titulo', 'MODIFICAR CLIENTE: ' . $c->nombre)
@section('contenido')
    <form action="{{ route('actualizarC', $c->id) }}" method="POST" enctype="multipart/form-data">
        @method('PUT')
        @csrf
        <div class="mb-3">
            <label for="id" class="form-label">Id</label>
            <input type="text" id="id" class="form-control" name="id" value="{{ $c->id }}"
                disabled="disabled">
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="text" id="email" class="form-control" name="email" placeholder="Email"
                value="{{ $c->email }}">
        </div>
        <div class="mb-3">
            <label for="telefono" class="form-label">Teléfono</label>
            <input type="text" id="telefono" class="form-control" name="telefono" value="{{ $c->telefono }}">
        </div>
        <div class="mb-3">
            <label for="direccion" class="form-label">Dirección</label>
            <input type="text" id="direccion" class="form-control" name="direccion" value="{{ $c->direccion }}">
        </div>
        <div class="mb-3">
            <button type="submit" class="btn btn-success">Modificar</button>
            <a href="{{ route('clientes') }}" class="btn btn-danger">Cancelar</a>
        </div>
    </form>
@endsection
