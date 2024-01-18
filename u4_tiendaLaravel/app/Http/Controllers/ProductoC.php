<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use Illuminate\Http\Request;

class ProductoC extends Controller
{
    //Método que maneja la ruta productos
    function productos()
    {
        //Recuperar los productos para mostrarlos en la tabla de la vista productos
        $productos = Producto::all();
        return view('productos/productos', compact('productos'));
    }
    //Método que maneja la ruta crearProducto
    function crear()
    {
        return view('productos/crearProducto');
    }

    //Este método se llama desde el submit del formulario para acceder a los campos del formulario
    //hay que definir un parámetro de la clase Request
    function insertar(Request $r)
    {
        //Crear un objeto del modelo Producto
        $p = new Producto();
        //Rellenar los datos del producto a partir de los datos del formulario
        $p->nombre = $r->nombre;
        $p->descripcion = $r->desc;
        $p->precio = $r->precio;
        $p->stock = $r->stock;
        $p->img = 'nombreIMG';
        //Hacemos el insert
        if ($p->save()) {
            //Volvemos a la página anterior (ruta productos) y mostramos mensaje de éxito
            return redirect()->route('productos')->with('mensaje', 'Producto creado con id ' . $p->id);
        } else {
            //Volvemos a la página anterior (ruta productos) y mostramos mensaje de error
            return back()->with('mensaje', 'Producto creado con id ' . $p->id);
        }
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
