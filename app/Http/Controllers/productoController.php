<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\producto;
use App\Servicio\ImagenServicio;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class productoController extends Controller
{
    public function index()
    {
        $productos = producto::where('user_id', Auth::user()->id)->get();
        foreach ($productos as $producto) {
            $producto->imagen_url = asset('storage/productos/' . $producto->imagen);
        }

        return response()->json($productos);
    }


    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'precio_unitario' => 'required|numeric|min:0',
            'precio_compra' => 'required|numeric|min:0',
            'categoria_id' => 'required|exists:categorias,id',
            'stock' => 'required|integer|min:0',
            'estado' => 'required',
            'imagen' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg',
        ]);

        $imagenServicio = new ImagenServicio();
        $imagen = null;
        if ($request->hasFile('imagen')) {
            $imagen = $imagenServicio->subirImagen($request->file('imagen'), 'productos/');
        }

        $producto = Producto::create([
            'nombre' => $request->nombre,
            'descripcion' => $request->descripcion,
            'precio_unitario' => $request->precio_unitario,
            'precio_compra' => $request->precio_compra,
            'categoria_id' => $request->categoria_id,
            'stock' => $request->stock,
            'stock_minimo' => $request->stock_minimo,
            'fecha_vencimiento' => $request->fecha_vencimiento,
            'estado' => $request->estado,
            'imagen' => $imagen,
            'user_id' => Auth::user()->id
        ]);

        return response()->json($producto);
    }

    public function show($id)
    {
        $producto = producto::where('user_id', Auth::user()->id)->find($id);
        $producto->imagen_url = asset('storage/productos/' . $producto->imagen);
        return response()->json($producto);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'precio_unitario' => 'required|numeric|min:0',
            'precio_compra' => 'required|numeric|min:0',
            'categoria_id' => 'required|exists:categorias,id',
            'stock' => 'required|integer|min:0',
            'estado' => 'required',
            'imagen' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg',
        ]);

        $producto = Producto::where('user_id', Auth::user()->id)->find($id);

        if (!$producto) {
            return response()->json(['error' => 'Producto no encontrado'], 404);
        }

        $imagenServicio = new ImagenServicio();
        $imagen = $producto->imagen;

        if ($request->hasFile('imagen')) {
            if ($producto->imagen) {
                $imagenServicio->eliminarImagen($producto->imagen, 'productos/');
            }
            $imagen = $imagenServicio->subirImagen($request->file('imagen'), 'productos/');
        }

        $producto->update([
            'nombre' => $request->nombre,
            'descripcion' => $request->descripcion,
            'precio_unitario' => $request->precio_unitario,
            'precio_compra' => $request->precio_compra,
            'categoria_id' => $request->categoria_id,
            'stock' => $request->stock,
            'stock_minimo' => $request->stock_minimo,
            'fecha_vencimiento' => $request->fecha_vencimiento,
            'estado' => $request->estado,
            'imagen' => $imagen,
        ]);

        return response()->json($producto);
    }


    public function destroy($id)
    {
        $producto = producto::where('user_id', Auth::user()->id)->find($id);
        $producto->delete();
        return response()->json(null, 204);
    }
}
