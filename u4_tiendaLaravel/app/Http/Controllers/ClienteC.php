<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ClienteC extends Controller
{
    function __construct()
    {
        $this->middleware('auth');
    }
    //Método que maneja la ruta productos
    function clientes()
    {
        //Recuperar los productos para mostrarlos en la tabla de la vista productos
        $clientes = Cliente::all();
        return view('clientes/clientes', compact('clientes'));
    }
    //Método que maneja la ruta crearProducto
    // function crear()
    // {
    //     return view('clientes/crearCliente');
    // }

    //Este método se llama desde el submit del formulario para acceder a los campos del formulario
    //hay que definir un parámetro de la clase Request
    // function insertar(Request $r)
    // {
    //     //Crear un objeto del modelo Producto
    //     $c = new Cliente();
    //     //Rellenar los datos del producto a partir de los datos del formulario
    //     $c->id = $r->id;
    //     $c->email = $r->email;
    //     $c->telefono = $r->telefono;
    //     $c->direccion = $r->direccion;
    //     //Hacemos el insert
    //     //$p->save sabe que hay que hacer un insert porque $p se ha creado con un find
    //     if ($c->save()) {
    //         //Volvemos a la página anterior (ruta productos) y mostramos mensaje de éxito
    //         return redirect()->route('clientes')->with('mensaje', 'Cliente creado con id ' . $c->id);
    //     } else {
    //         //Volvemos a la página anterior (ruta productos) y mostramos mensaje de error
    //         return back()->with('mensaje', 'Cliente creado con id ' . $c->id);
    //     }
    // }
    //Método que maneja la ruta verProducto
    function ver($idC)
    {
        return 'Página para ver el cliente ' . $idC;
    }
    //Método que maneja la ruta modificarProducto
    function modificar($idC)
    {
        $c = Cliente::find($idC);
        return view('clientes/modificarCliente', compact('c'));
    }

    function actualizar(Request $r, $idC)
    {
        //Recuperar los datos del producto antes de modificar
        //es el producto tal cual está en la BD
        $c = Cliente::find($idC);
        //Modificamos los campos que se hayan podido cambiar en el formulario
        //$p tiene los datos modificados y $p los antiguos
        $c->email = $r->email;
        $c->telefono = $r->telefono;
        $c->direccion = $r->direccion;
        $error = false;
        try {
            DB::transaction(function () use ($c) {
                if ($c->save()) {
                    if (!$c->usuario->save()) {
                        return back()->with('mensaje', 'Error, no se ha modificado el cliente');
                    }
                } else {
                    return back()->with('mensaje', 'Error, no se ha modificado el cliente');
                }
            });
        } catch (Exception $e) {
            $error = true;
            return back()->with('mensaje', 'Error, no se ha modificado el cliente');
        } finally {
            if (!$error) {
                return redirect()->route('clientes')->with('mensaje', 'Cliente modificado correctamente');
            }
        }
    }
    //Método que maneja la ruta borrarProducto
    function borrar($idC)
    {
        //Obtener el producto a borrar
        $c = Cliente::find($idC);

        //Si tiene pedidos no podemos borrar el productos
        if (sizeof($c->pedidos()) > 0) {
            return back()->with('mensaje', 'Error, el cliente tiene pedidos');
        } else {
            $error = false;
            try {
                DB::transaction(function () use ($c) {
                    if ($c->delete()) {
                        if (!$c->usuario->delete()) {
                            return back()->with('mensaje', 'Error, no se ha borrado el usuario');
                        }
                    } else {
                        return back()->with('mensaje', 'Error, no se ha borrado el cliente');
                    }
                });
            } catch (Exception $e) {
                $error = true;
                return back()->with('mensaje', 'Error, no se ha borrado el cliente');
            } finally {
                if (!$error) {
                    return redirect()->route('clientes')->with('mensaje', 'Cliente borrado correctamente');
                }
            }
        }
    }
}
