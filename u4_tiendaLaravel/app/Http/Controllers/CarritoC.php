<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use Illuminate\Http\Request;

class CarritoC extends Controller
{
    function __construct()
    {
        $this->middleware('auth');
    }
    //
    function insertarCarrito($idP)
    {
        //Recuperar el producto
        $producto = Producto::find($idP);

        //Añadir al carrito el producto
        //El carrito se almacenará en una variable de sesión
        if (session('carrito') == null) {
            //Crear la variable de sesión
            session(['carrito' => array()]);
        }
        //Comprobar si el producto está en el carrito
        $actualizado = false;
        foreach (session('carrito') as $pc) {
            if ($pc['producto']->id == $producto->id) {
                $pc['cantidad'] += 1;
                $actualizado = true;
            }
        }
        if (!$actualizado) {
            //Añadir al carrito el producto
            session('carrito')[] = array('producto' => $producto, 'cantidad' => 1);
        }
        //Añadir al carrito el producto
        session('carrito')[] = $producto;
    }
}
