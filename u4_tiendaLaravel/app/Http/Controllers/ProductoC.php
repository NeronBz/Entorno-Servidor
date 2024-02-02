<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductoC extends Controller
{
    function __construct()
    {
        $this->middleware('auth');
    }
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
        //Hacer las validaciones
        //Todos los campos deben estra rellenos
        //El nombre del producto no se puede repetir, porque es unique
        //Precio y stock no pueden ser negativos

        //Validar:Admite un array con todas las validaciones
        //Hay que indicar el name del campo a validar
        //y las validaciones sobre él. Si hay más de una se separan por |
        $r->validate([
            'nombre' => 'required|unique:App\Models\Producto,nombre',
            'desc' => 'required',
            'precio' => 'required|gte:0',
            'stock' => 'required|gte:0',
            'imagen' => 'required'
        ]);

        //Crear un objeto del modelo Producto
        $p = new Producto();
        //Rellenar los datos del producto a partir de los datos del formulario
        $p->nombre = $r->nombre;
        $p->descripcion = $r->desc;
        $p->precio = $r->precio;
        $p->stock = $r->stock;
        //Subir imagen del producto al servidor y rellenar el producto con la ruta de la imagen
        //El fichero se almacena en storage/app/public/img/productos
        $ruta = $r->file('imagen')->store('img/productos', 'public');
        $p->img = $ruta;
        //Hacemos el insert
        //$p->save sabe que hay que hacer un insert porque $p se ha creado con un find
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
        $p = Producto::find($idP);
        return view('productos/modificarProducto', compact('p'));
    }

    function actualizar(Request $r, $idP)
    {
        $r->validate([
            'nombre' => 'required',
            'desc' => 'required',
            'precio' => 'required|gte:0',
            'stock' => 'required|gte:0'
        ]);
        //Recuperar los datos del producto antes de modificar
        //es el producto tal cual está en la BD
        $p = Producto::find($idP);

        //Validar si se ha cambiado el nombre del producto
        //Que no esté repetido
        if ($p->nombre != $r->nombre) {
            $r->validate([
                'nombre' => 'required|unique:App\Models\Producto,nombre',
                'desc' => 'required',
                'precio' => 'required|gte:0',
                'stock' => 'required|gte:0'
            ]);
        }
        //Modificamos los campos que se hayan podido cambiar en el formulario
        //$p tiene los datos modificados y $p los antiguos
        $p->nombre = $r->nombre;
        $p->descripcion = $r->desc;
        $p->precio = $r->precio;
        $p->stock = $r->stock;

        //Subir nueva imagen solamente si se ha modificado
        if (!empty($r->imagen)) {
            //Borrar la imagen antigua
            Storage::delete('public/' . $p->imagen);
            //Subir la imagen nueva
            $ruta = $r->file('imagen')->store('img/productos', 'public');
            $p->img = $ruta;
        }

        //Modificar el producto en la BD
        //Sabe que hay que hacer un update porque $p se ha creado con un find
        if ($p->save()) {
            return redirect()->route('productos')->with('mensaje', 'Producto modificado correctamente');
        } else {
            return back()->with('mensaje', 'Error, no se ha modificado el producto');
        }
    }
    //Método que maneja la ruta borrarProducto
    function borrar($idP)
    {
        //Obtener el producto a borrar
        $p = Producto::find($idP);

        //Si tiene pedidos no podemos borrar el producto
        if (sizeof($p->detalle_pedidos()) > 0) {
            return back()->with('mensaje', 'Error, el producto se ha pedido');
        } else {
            if ($p->delete()) {
                Storage::delete('public/' . $p->imagen);
                return back()->with('mensaje', 'Producto borrado');
            }
        }
    }
}
