<?php

namespace App\Http\Controllers;

use App\Models\ApiReserva;
use App\Models\Reserva;
use App\Models\Viaje;
use Illuminate\Http\Request;

class ApiReservaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        return Reserva::all();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(ApiReserva $apiReserva)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        //
        $rsv = Reserva::find($id);
        if ($rsv->anulada == false) {
            $rsv->anulada = true;
            if ($rsv->save()) {
                $viaje = Viaje::find($rsv->viaje_id);
                $viaje->nPlazas = $viaje->nPlazas + $rsv->nPersonas;
            }
        } else {
            return abort('Esta reserva ya está anulada', 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ApiReserva $apiReserva)
    {
        //
    }
}
