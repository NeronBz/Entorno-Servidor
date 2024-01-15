<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PedidoC extends Controller
{
    function pedidos()
    {
        return view('pedidos/pedidos');
    }
    function crearPe()
    {
        return view('pedidos/crearPedido');
    }

    function insertar()
    {
        return 'Página para insertar un producto';
    }
    function ver($idP)
    {
        return 'Página para ver el producto ' . $idP;
    }
    function modificar($idP)
    {
        return 'Página para modificar un producto ' . $idP;
    }
    function borrar($idP)
    {
        return 'Página para borrar un producto ' . $idP;
    }
}
