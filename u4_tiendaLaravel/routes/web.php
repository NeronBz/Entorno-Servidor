<?php

use App\Http\Controllers\CarritoC;
use App\Http\Controllers\ClienteC;
use App\Http\Controllers\LoginC;
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
    Route::get('productos/crearProducto', 'crear')->name('crearProducto');
    Route::post('productos/insertar', 'insertar')->name('insertarProducto');

    //Definir una ruta con un parámetro
    //Ruta para borrar un producto concreto, pasando el id
    Route::delete('productos/borrar/{idP}', 'borrar')->name('borrarP');

    //Definir una ruta con un parámetro
    //Ruta para modificar un producto concreto, pasando el id
    Route::get('productos/modificar/{idP}', 'modificar')->name('modificarP');
    Route::put('productos/modificar/{idP}', 'actualizar')->name('actualizarP');

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
    // Route::get('clientes/crearCliente', 'crear')->name('crearCliente');
    // Route::post('clientes/insertar', 'insertar')->name('insertarCliente');

    //Definir una ruta con un parámetro
    //Ruta para borrar un producto concreto, pasando el id
    Route::delete('clientes/borrar/{idC}', 'borrar')->name('borrarC');

    //Definir una ruta con un parámetro
    //Ruta para modificar un producto concreto, pasando el id
    Route::get('clientes/modificar/{idC}', 'modificar')->name('modificarC');
    Route::put('clientes/modificar/{idC}', 'actualizar')->name('actualizarC');

    //Definir una ruta con un parámetro
    //Ruta para ver un producto concreto, pasando el id
    Route::get('clientes/{idC}', 'ver')->name('verC');
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

Route::controller(LoginC::class)->group(function () {
    //Definir una ruta básica para ver todos los productos
    //Ruta para ver todos los productos
    Route::get('login', 'login')->name('login'); //Carga el formulario login
    Route::get('login/registro', 'registro')->name('registro'); //Carga form registro
    Route::get('login/salir', 'salir')->name('salir'); //Cierra sesión
    Route::post('login', 'loguear')->name('loguear'); //Inicia sesión si us y ps son válidos
    Route::post('login/registro', 'registrar')->name('registrar'); //Crea usuario y clientes
});

Route::controller(CarritoC::class)->group(function () {
    Route::post('carrito', 'insertarCarrito')->name('aCarrito');
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
