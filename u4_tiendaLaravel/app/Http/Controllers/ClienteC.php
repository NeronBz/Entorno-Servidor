<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ClienteC extends Controller
{
    function clientes()
    {
        return view('clientes/clientes');
    }
    function crear()
    {
        return view('clientes/crearCliente');
    }
}
