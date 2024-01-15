<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProductoC extends Controller
{
    //Método que maneja la ruta productos
    function productos()
    {
        return view('productos/productos');
    }
    //Método que maneja la ruta crearProducto
    function crear()
    {
        return view('productos/crear');
    }

    function insertar()
    {
        return 'Página para insertar un producto';
    }
    //Método que maneja la ruta verProducto
    function ver($idP)
    {
        return 'Página para ver el producto ' . $idP;
    }
    //Método que maneja la ruta modificarProducto
    function modificar($idP)
    {
        return 'Página para modificar un producto ' . $idP;
    }
    //Método que maneja la ruta borrarProducto
    function borrar($idP)
    {
        return 'Página para borrar un producto ' . $idP;
    }
}
