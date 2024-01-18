<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    use HasFactory;

    function pedidos()
    {
        //Si no seguimos la covención de nombres de Laravel
        //return $this->HasMany(Pedido::class, 'cliente_id', 'id')->get();
        //Si seguimos la covención de nombres de Laravel
        return $this->HasMany(Pedido::class)->get();
    }
}
