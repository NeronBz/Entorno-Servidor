@extends('plantilla/plantilla')
@section('titulo', 'CREAR PRODUCTOS')
@section('contenido')
    <form action="{{ route('insertarProducto') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label for="nombre" class="form-label">Nombre</label>
            <input type="text" id="nombre" class="form-control" name="nombre" placeholder="Nombre"
                value="{{ old('nombre') }}">
            @error('nombre')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
        <div class="mb-3">
            <label for="desc" class="form-label">Descripción</label>
            <input type="text" id="desc" class="form-control" name="desc" placeholder="Descripción"
                value="{{ old('desc') }}">
            @error('desc')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
        <div class="mb-3">
            <label for="precio" class="form-label">Precio</label>
            <input type="number" id="precio" class="form-control" name="precio" step="0.01"
                value="{{ old('precio') }}">
            @error('precio')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
        <div class="mb-3">
            <label for="stock" class="form-label">Stock</label>
            <input type="number" id="stock" class="form-control" name="stock" value="{{ old('stock') }}">
            @error('stock')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
        <div class="mb-3">
            <label for="imagen" class="form-label">Imagen</label>
            <input type="file" id="imagen" class="form-control" name="imagen" value="{{ old('imagen') }}">
            @error('imagen')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
        <div class="mb-3">
            <button type="submit" class="btn btn-success">Crear Producto</button>
            <a href="{{ route('productos') }}" class="btn btn-danger">Cancelar</a>
        </div>
    </form>
@endsection
