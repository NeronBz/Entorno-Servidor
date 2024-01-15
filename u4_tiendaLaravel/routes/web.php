<?php

use App\Http\Controllers\ClienteC;
use App\Http\Controllers\PedidoC;
use App\Http\Controllers\ProductoC;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
})->name('inicio');

Route::controller(ProductoC::class)->group(function () {
    //Definir una ruta básica para ver todos los productos
    //Ruta para ver todos los productos
    Route::get('productos', 'productos')->name('productos');

    //Definir ruta para crear un producto
    //Ruta básica
    Route::get('productos/crear', 'crear')->name('crearProducto');
    Route::post('productos/insertar', 'insertar')->name('insertarProducto');

    //Definir una ruta con un parámetro
    //Ruta para borrar un producto concreto, pasando el id
    Route::get('productos/borrar/{idP}', 'borrar')->name('borrarP');

    //Definir una ruta con un parámetro
    //Ruta para modificar un producto concreto, pasando el id
    Route::get('productos/modificar/{idP}', 'modificar')->name('modificarP');

    //Definir una ruta con un parámetro
    //Ruta para ver un producto concreto, pasando el id
    Route::get('productos/{idP}', 'ver')->name('verP');
});

Route::controller(ClienteC::class)->group(function () {
    //Definir una ruta básica para ver todos los productos
    //Ruta para ver todos los productos
    Route::get('clientes', 'clientes')->name('clientes');

    //Definir ruta para crear un producto
    //Ruta básica
    Route::get('clientes/crearCliente', 'crearCliente')->name('crearCliente');
    Route::post('clientes/insertar', 'insertar')->name('insertarCliente');

    //Definir una ruta con un parámetro
    //Ruta para borrar un producto concreto, pasando el id
    Route::get('clientes/borrar/{idP}', 'borrar')->name('borrarC');

    //Definir una ruta con un parámetro
    //Ruta para modificar un producto concreto, pasando el id
    Route::get('clientes/modificar/{idP}', 'modificar')->name('modificarC');

    //Definir una ruta con un parámetro
    //Ruta para ver un producto concreto, pasando el id
    Route::get('clientes/{idP}', 'ver')->name('verC');
});

Route::controller(PedidoC::class)->group(function () {
    //Definir una ruta básica para ver todos los productos
    //Ruta para ver todos los productos
    Route::get('pedidos', 'pedidos')->name('pedidos');

    //Definir ruta para crear un producto
    //Ruta básica
    Route::get('pedidos/crearPedido', 'crearPedido')->name('crearPedido');
    Route::post('pedidos/insertar', 'insertar')->name('insertarPedido');

    //Definir una ruta con un parámetro
    //Ruta para borrar un producto concreto, pasando el id
    Route::get('pedidos/borrar/{idP}', 'borrar')->name('borrarPe');

    //Definir una ruta con un parámetro
    //Ruta para modificar un producto concreto, pasando el id
    Route::get('pedidos/modificar/{idP}', 'modificar')->name('modificarPe');

    //Definir una ruta con un parámetro
    //Ruta para ver un producto concreto, pasando el id
    Route::get('pedidos/{idP}', 'ver')->name('verPe');
});


//Definir ruta con dos parámetros
Route::get('productos/modificar/{idP}/{texto}', function ($idP, $texto) {
    echo '<h1>' . $texto . '<h1>';
    echo 'Página para ver un producto ' . $idP;
});

//Definir ruta con dos parámetros y uno de ellos opcional
Route::get('productos/opt/{idP}/{texto?}', function ($idP, $texto = null) {
    echo '<h1>' . $texto != null ? $texto : "" . '<h1>';
    echo 'Página para ver una cosa ' . $idP;
});
