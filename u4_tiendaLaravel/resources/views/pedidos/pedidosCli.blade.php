@extends('plantilla/plantilla')
@section('titulo', 'PEDIDOS DE '.Auth::user()->name)
@section('mensaje')
    <h3 class="text-danger">Espacio para mensaje</h3>
@endsection
@section('contenido')
<form action="{{route('crearPedido')}}" method="GET" class="d-flex justify-content-center">
    <button type="submit" class="btn btn-info">Crear Pedido</button>
</form>
<table class="table">
    <thead class="table-dark">
      <tr>
        <th scope="col">Id</th>
      </tr>
    </thead>
    <tbody>
      @foreach ($pedidos as $pe)
          <tr>
              <th scope="row">{{ $pe->id }}</th>
          </tr>
      @endforeach
  </tbody>
  </table>  
@endsection