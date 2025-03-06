<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class producto extends Model
{
    use HasFactory;

    protected $fillable = [ 'user_id', 'nombre', 'precio_unitario', 'precio_compra', 'descripcion', 
    'stock', 'stock_minimo', 'fecha_vencimiento', 'estado', 'imagen', 'categoria_id'];

    
    public function categoria()
    {
        return $this->belongsTo(categoria::class);
    }
}
