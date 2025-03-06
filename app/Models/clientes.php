<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class clientes extends Model
{
    use HasFactory;
    
    protected $fillable = [ 'user_id', 'nombre', 'dni', 'telefono', 'correo', 'direccion'];

}
