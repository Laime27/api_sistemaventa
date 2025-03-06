<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ventas;
use Illuminate\Support\Facades\Auth;
use App\Models\detalle_ventas;
    
class ventaController extends Controller
{
    public function index()
    {
        $ventas = ventas::where('user_id', Auth::user()->id)->get();
        return response()->json($ventas);
    }
    

    public function store(Request $request)
    {
        $request->validate([
            'cliente_id' => 'required|exists:clientes,id',
            'subtotal' => 'required|numeric|min:0',
            'descuento' => 'nullable|numeric|min:0',
            'total' => 'required|numeric|min:0',
            'forma_pago' => 'required|string|in:efectivo,tarjeta,transferencia',
        ]);

        $venta = ventas::create([
            'user_id' => Auth::user()->id,
            'cliente_id' => $request->cliente_id,
            'subtotal' => $request->subtotal,
            'descuento' => $request->descuento,
            'total' => $request->total,
            'forma_pago' => $request->forma_pago,
        ]);

     
        foreach ($request->productos as $producto) {
            $detalle_venta = detalle_ventas::create([
                'user_id' => Auth::user()->id,
                'venta_id' => $venta->id,
                'producto_id' => $producto['id'],
                'cantidad' => $producto['cantidad'],
                'precio' => $producto['precio'],
            ]);
        }

        return response()->json($venta, 201);
        
        
    }
    
    
    
    
    
}
