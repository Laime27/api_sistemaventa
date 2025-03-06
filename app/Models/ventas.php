<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
class ventas extends Model
{
    use HasFactory;

    protected $fillable = [ 'user_id', 'cliente_id', 'subtotal', 'descuento', 'total', 'forma_pago'];

    public function cliente()
    {
        return $this->belongsTo(clientes::class);
    }
}
