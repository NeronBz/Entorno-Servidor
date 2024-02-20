<?php

use App\Http\Controllers\LibroC;
use App\Http\Controllers\PrestamoC;
use App\Models\Libro;
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

Route::controller(LibroC::class)->group(
    function () {
    }
);

Route::controller(PrestamoC::class)->group(
    function () {
        //Primer string: lo que tengo que poner en la ruta del navegador
        //Segundo string: la función que va a tratar esa ruta, en el controller
        //Tercer string: el nombre que tiene que tiene esta ruta, cuando en la vista
        // queremos hacer un redirect
        Route::get('verPrestamos', 'ver')->name('rutaVer');
        Route::get('crearPrestamos', 'crear')->name('rutaCrear');
        Route::get('modificarPrestamo/{id}', 'modificar')->name('rutaModificar');
        Route::post('insertarPrestamos', 'insertar')->name('rutaInsertar');
        Route::post('modificarPrestamo/{id}', 'actualizar')->name('rutaActualizar');
    }
);
