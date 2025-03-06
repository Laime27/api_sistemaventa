<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\producto;
use App\Servicio\ImagenServicio;
use Illuminate\Support\Facades\Auth;
class productoController extends Controller
{
    public function index()
    {
        $productos = producto::where('user_id', Auth::user()->id)->get();
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
            'estado' => 'required|in:activo,inactivo',
            'imagen' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $imagenServicio = new ImagenServicio();

        if ($request->hasFile('imagen')) {
            $imagen = $imagenServicio->subirImagen($request->file('imagen'), 'productos/');
            $request['imagen'] = $imagen;
        }
        $producto = producto::create($request->all());
        return response()->json($producto);

    }
    
    public function show($id)
    {
        $producto = producto::where('user_id', Auth::user()->id)->find($id);
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
            'estado' => 'required|in:activo,inactivo',
            'imagen' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $producto = producto::where('user_id', Auth::user()->id)->find($id);


        $imagenServicio = new ImagenServicio();

        if ($request->hasFile('imagen')) {
            $imagen = $imagenServicio->eliminarImagen($producto->imagen, 'productos/');
            $imagen = $imagenServicio->subirImagen($request->file('imagen'), 'productos/');

            $request['imagen'] = $imagen;
        }
       
        $producto->update($request->all());
        return response()->json($producto);
    }

    public function destroy($id)
    {
        $producto = producto::where('user_id', Auth::user()->id)->find($id);
        $producto->delete();
        return response()->json(null, 204);
    }




    
    

}
