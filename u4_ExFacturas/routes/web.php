<?php

use App\Http\Controllers\ProductoC;
use App\Http\Controllers\VentaC;
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
});

Route::controller(VentaC::class)->group(
    function () {
        //Primer string: lo que tengo que poner en la ruta del navegador
        //Segundo string: la función que va a tratar esa ruta, en el controller
        //Tercer string: el nombre que tiene que tiene esta ruta, cuando en la vista
        // queremos hacer un redirect
        Route::get('verFacturas', 'ver')->name('rutaVer');
        Route::get('crearFacturas', 'crear')->name('rutaCrear');
        Route::get('modificarFactura/{id}', 'modificar')->name('rutaModificar');
        Route::post('insertarFacturas', 'insertar')->name('rutaInsertar');
        Route::post('modificarFactura/{id}', 'actualizar')->name('rutaActualizar');
    }
);

Route::controller(ProductoC::class)->group(
    function () {
    }
);
