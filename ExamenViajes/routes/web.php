<?php

use App\Http\Controllers\ReservaC;
use App\Http\Controllers\ViajeC;
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

Route::controller(ViajeC::class)->group(
    function () {
        //Primer string: lo que tengo que poner en la ruta del navegador
        //Segundo string: la función que va a tratar esa ruta, en el controller
        //Tercer string: el nombre que tiene que tiene esta ruta, cuando en la vista
        // queremos hacer un redirect
        Route::get('verViajes', 'ver')->name('rutaVer');
    }
);

Route::controller(ReservaC::class)->group(
    function () {
        Route::get('crearReservas', 'crear')->name('rutaCrear');
        Route::post('insertarReservas', 'insertar')->name('rutaInsertar');
    }
);
