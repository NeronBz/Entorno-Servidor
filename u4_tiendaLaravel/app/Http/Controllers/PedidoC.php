<?php

namespace App\Http\Controllers;

use App\Models\Pedido;
use App\Models\Cliente;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PedidoC extends Controller
{
    function __construct()
    {
        $this->middleware('auth');
    }
    function pedidos()
    {
        //Recuperar los pedidos para mostrarlos en la tabla de la vista pedidos
        if (Auth::user()->tipo == 'A') {
            $pedidos = Pedido::all();
            //Vista admin
            return view('pedidos/pedidos', compact('pedidos'));
        } else {
            //Recuperar el cliente asociado al usuario
            //BHacer un select * from cliente where user_id=Auth::user->id limit 1
            $cliente = Cliente::where('user_id', Auth::user()->id)->first();
            //Recuperar sus pedidos
            //Hacemos un select * from pedidos where cliente_id = idClienteLogueado
            $pedidos = Pedido::where('cliente_id', $cliente->id)->get();
            //Vista cliente
            return view('pedidos/pedidosCli', compact('pedidos'));
        }
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
