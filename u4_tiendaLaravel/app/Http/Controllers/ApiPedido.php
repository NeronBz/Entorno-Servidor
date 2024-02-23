<?php

namespace App\Http\Controllers;

use App\Models\Pedido;
use Illuminate\Http\Request;
use App\Models\Producto;
use App\Models\Cliente;
use Illuminate\Support\Facades\DB;

class ApiPedido extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //Crea un pedido con un producto
        //Parámetros: idP, idC, cantidad, 
        $request->validate([
            'idP' => 'required',
            'idC' => 'required',
            'cantidad' => 'required|gte:1',
        ]);
        $p = Producto::find($request->idP);
        if ($p == null) {
            return response()->json('Error, no existe el producto', 500);
        }
        if ($p->stock < $request->cantidad) {
            return response()->json('Error, no hay stock', 500);
        }
        $c = Cliente::find($request->idC);
        if ($p->stock < $request->cantidad) {
            return response()->json('Error, no hay stock', 500);
        }
        $error = false;
        try {
            //Creamos el pedido en una transacción
            //ya que hay que hacer inserts en 2 tablas: pedidos y pedido_productos
            DB::transaction(function () use ($request) {
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


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
