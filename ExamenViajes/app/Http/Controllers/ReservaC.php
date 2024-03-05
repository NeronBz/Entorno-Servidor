<?php

namespace App\Http\Controllers;

use App\Models\Reserva;
use App\Models\Viaje;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReservaC extends Controller
{
    //
    function crear()
    {
        $viajes = Viaje::all();
        return view('crearR', compact('viajes'));
    }

    function insertar(Request $r)
    {
        $r->validate([
            'viaje' => 'required',
            'fecha' => 'required',
            'nombre' => 'required',
            'nPersonas' => 'required',
        ]);
        //Chequear plazas
        $pl = Viaje::find($r->viaje);
        if ($pl != null and $pl->nPlazas > $r->nPersonas) {
            $error = false;
            $mensaje = "";
            try {
                DB::transaction(function () use ($r, $error) {
                    $pl = Viaje::find($r->viaje);
                    //Insert
                    $rsv = new Reserva();
                    $rsv->viaje_id = $r->viaje;
                    $rsv->fecha = $r->fecha;
                    $rsv->nombre = $r->nombre;
                    $rsv->nPersonas = $r->nPersonas;
                    $rsv->total = $r->nPersonas * $pl->pPersona;
                    $rsv->anulada = false;
                    if ($rsv->save()) {
                        //Modificar el stock
                        $pl->nPlazas =  $pl->nPlazas - $rsv->nPersonas;
                        if (!$pl->save()) {
                            $error = true;
                        }
                    } else {
                        $error = true;
                    }
                });
            } catch (Exception $e) {
                $error = true;
                $mensaje = $e->getMessage();
            } finally {
                if ($error) {
                    return back()->with('mensaje', $mensaje);
                } else {
                    return redirect()->route('rutaVer');
                }
            }
        } else {
            return back()->with('mensaje', 'Error, viaje no existe o no hay plazas libres');
        }
    }
}
