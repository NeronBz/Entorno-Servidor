<?php

namespace App\Http\Controllers;

use App\Models\Pedido;
use App\Models\Cliente;
use App\Models\Pedido_Producto;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use PDOException;

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
    function crearPedido()
    {
        if (session('carrito') == null or sizeof(session('carrito')) == 0) {
            return back()->with('mensaje', 'Error no hay productos en el carrito');
        }
        $error = false;
        try {
            //Creamos el pedido en una transacción
            //ya que hay que hacer inserts en 2 tablas: pedidos y pedido_productos
            DB::transaction(function () {
                //Crear el pedido a partir de la variable de sesión y del usuario logueado
                $p = new Pedido();
                $p->fecha = date('YmdHis');
                //Recuperamos el cliente
                $c = Cliente::where('user_id', Auth::user()->id)->first();
                $p->cliente_id = $c->id;

                //Guardar pedido
                if ($p->save()) {
                    //Crear un pedido_producto para cada producto que haya en el carrito
                    $carrito = session('carrito');
                    foreach ($carrito as $pc) {
                        $nuevo = new Pedido_Producto();
                        $nuevo->cantidad = $pc['cantidad'];
                        $nuevo->precioU = $pc['producto']->precio;
                        $nuevo->pedido_id = $p->id;
                        $nuevo->producto = $pc['producto']->id;
                        $nuevo->save();
                    }
                }
            });
        } catch (Exception $e) {
            $error = true;
            return back()->with('mensaje', 'Error no se ha creado el pedido' . $e->getMessage());
        } finally {
            if (!$error) {
                //Eliminar el carrito de la sesión
                session()->forget('carrito');
                return redirect()->route('pedidos')->with('mensaje', 'Pedido creado');
            }
        }
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
