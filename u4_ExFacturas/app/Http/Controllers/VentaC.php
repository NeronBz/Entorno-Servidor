<?php

namespace App\Http\Controllers;

use App\Models\Venta;
use Illuminate\Http\Request;
use App\Models\Producto;
use Exception;
use Illuminate\Support\Facades\DB;

class VentaC extends Controller
{
    //
    function ver()
    {
        //Obtener los préstamos de la BD
        $ventas = Venta::orderBy('fecha', 'desc')->orderBy('id', 'asc')->get();
        //Cargar la vista
        return view('verF', compact('ventas'));
    }
    function crear()
    {
        //Recuperar los productos
        $productos = Producto::all();
        //Cargar la vista
        return view('crearF', compact('productos'));
    }
    function modificar($id)
    {
        $v = Venta::find($id);
        $productos = Producto::all();
        return view('modificarF', compact('v', 'productos'));
    }

    function insertar(Request $r)
    {
        $r->validate([
            'fecha' => 'required',
            'producto' => 'required',
            'cantidad' => 'required',
        ]);
        //Chequear stock
        $p = Producto::find($r->producto);
        if ($p != null and $p->stock > 0) {
            $error = false;
            $mensaje = "";
            try {
                DB::transaction(function () use ($r, $error) {
                    $p = Producto::find($r->producto);
                    //Insert
                    $v = new Venta();
                    $v->fecha = $r->fecha;
                    $v->producto_id = $r->producto;
                    $v->precioUnitario = $p->precio;
                    $v->cantidad = $r->cantidad;
                    if ($v->save()) {
                        //Modificar el stock
                        $v->producto->stock = $v->producto->stock - 1;
                        if (!$v->producto->save()) {
                            $error = true;
                        }
                    } else {
                        $error = true;
                    }
                });
            } catch (Exception $e) {
                $mensaje = $e->getMessage();
            } finally {
                if ($error) {
                    return back()->with('mensaje', $mensaje);
                } else {
                    return redirect()->route('rutaVer');
                }
            }
        } else {
            return back()->with('mensaje', 'Error, producto no existe o no hay stock');
        }
    }

    function actualizar(Request $r, $id)
    {
        $r->validate([
            'fecha' => 'required',
            'producto' => 'required',
            'cantidad' => 'required',
        ]);

        // Encontrar la venta existente
        $v = Venta::find($id);

        // Guardar el ID del producto anterior para comparar más tarde
        $productoAntiguo = $v->producto_id;

        // Verificar si se cambia el producto
        if ($v->producto_id != $r->producto) {
            // Se cambia el producto, entonces verificamos el stock del nuevo producto
            $p = Producto::find($r->producto);
            if ($p == null or $p->stock <= 0) {
                return back()->with('mensaje', 'Producto no existe o no hay stock');
            }
        }

        // Cambiar los datos de la venta por los nuevos
        $v->fecha = $r->fecha;
        $v->producto_id = $r->producto;
        $v->precioUnitario = $p->precio;
        $v->cantidad = $r->cantidad;

        // Inicializar la variable de error y mensaje
        $error = false;
        $mensaje = "";

        try {
            DB::transaction(function () use ($v, $r, $productoAntiguo, &$error) {
                if ($v->save()) {
                    // Si el producto no cambia, solo se modifica la cantidad
                    if ($v->producto_id == $productoAntiguo) {
                        // Actualizar el stock del producto anterior sumando la cantidad anterior
                        $productoAntiguo = Producto::find($productoAntiguo);
                        $productoAntiguo->stock += $v->cantidad; // Sumar la cantidad anterior
                        if (!$productoAntiguo->save()) {
                            $error = true;
                        }
                    }
                } else {
                    $error = true;
                }
            });
        } catch (Exception $e) {
            $mensaje = $e->getMessage();
            $error = true;
        } finally {
            // Verificar si hubo un error durante la transacción
            if ($error) {
                return back()->with('mensaje', $mensaje);
            } else {
                return redirect()->route('rutaVer');
            }
        }
    }
}
