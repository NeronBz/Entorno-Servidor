@extends('plantilla/plantilla')
@section('titulo', 'MODIFICAR PRODUCTO: ' . $p->nombre)
@section('contenido')
    <form action="{{ route('actualizarP', $p->id) }}" method="POST" enctype="multipart/form-data">
        @method('PUT')
        @csrf
        <div class="mb-3">
            <label for="id" class="form-label">Id</label>
            <input type="text" id="id" class="form-control" name="id" value="{{ $p->id }}"
                disabled="disabled">
            @error('id')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
        <div class="mb-3">
            <label for="nombre" class="form-label">Nombre</label>
            <input type="text" id="nombre" class="form-control" name="nombre" placeholder="Nombre"
                value="{{ $p->nombre }}">
            @error('nombre')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
        <div class="mb-3">
            <label for="desc" class="form-label">Descripción</label>
            <input type="text" id="desc" class="form-control" name="desc" placeholder="Descripción"
                value="{{ $p->descripcion }}">
            @error('desc')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
        <div class="mb-3">
            <label for="precio" class="form-label">Precio</label>
            <input type="number" id="precio" class="form-control" name="precio" step="0.01"
                value="{{ $p->precio }}">
            @error('precio')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
        <div class="mb-3">
            <label for="stock" class="form-label">Stock</label>
            <input type="number" id="stock" class="form-control" name="stock" value="{{ $p->stock }}">
            @error('stock')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
        <div class="mb-3">
            <label for="imagen" class="form-label">Imagen</label>
            <img src="{{ asset('storage/' . $p->img) }}">
            <input type="file" id="imagen" class="form-control" name="imagen">
            @error('imagen')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
        <div class="mb-3">
            <button type="submit" class="btn btn-success">Modificar</button>
            <a href="{{ route('productos') }}" class="btn btn-danger">Cancelar</a>
        </div>
    </form>
@endsection
