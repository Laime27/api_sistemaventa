<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class detalle_ventas extends Model
{
    use HasFactory;

    protected $fillable = [ 'user_id', 'venta_id', 'producto_id', 'cantidad', 'precio'];

    public function venta()
    {
        return $this->belongsTo(ventas::class);
    }

    public function producto()
    {
        return $this->belongsTo(producto::class);
    }
}
