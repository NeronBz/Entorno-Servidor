<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pedido_Producto extends Model
{
    use HasFactory;
    protected $table = 'pedido_productos';

    function pedido()
    {
        return $this->belongsTo(Pedido::class);
    }

    function producto()
    {
        return $this->belongsTo(Producto::class, 'producto', 'id');
    }
}
