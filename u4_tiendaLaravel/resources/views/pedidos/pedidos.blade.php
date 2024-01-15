@extends('plantilla/plantilla')
@section('titulo', 'PEDIDOS')
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
        <th scope="col">Email</th>
        <th scope="col">Teléfono</th>
        <th scope="col">Dirección</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <th scope="row">1</th>
        <td>Mark</td>
        <td>Otto</td>
        <td>@youtube</td>
      </tr>
      <tr>
        <th scope="row">2</th>
        <td>Jacob</td>
        <td>Thornton</td>
        <td>@threads</td>
      </tr>
      <tr>
        <th scope="row">3</th>
        <td>Larry</td>
        <td>the Bird</td>
        <td>@twitter</td>
      </tr>
    </tbody>
  </table>  
@endsection