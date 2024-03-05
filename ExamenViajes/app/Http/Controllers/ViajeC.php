<?php

namespace App\Http\Controllers;

use App\Models\Viaje;
use Illuminate\Http\Request;

class ViajeC extends Controller
{
    //
    function ver()
    {
        $viajes = Viaje::all();
        return view('verV', compact('viajes'));
    }
}
