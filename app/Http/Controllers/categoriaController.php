<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\categoria;
use Illuminate\Support\Facades\Auth;

class categoriaController extends Controller
{
    public function index()
    {
        $categorias = categoria::where('user_id', Auth::user()->id)->get();
        return response()->json($categorias);
    }


    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
        ]);

        $request['user_id'] = Auth::user()->id;

        $categoria = categoria::create($request->all());
        return response()->json($categoria);
    }

    public function show($id)
    {
        $categoria = categoria::where('user_id', Auth::user()->id)->find($id);
        return response()->json($categoria);
    }


    public function update(Request $request, $id)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
        ]);
        $categoria = categoria::where('user_id', Auth::user()->id)->find($id);
        $categoria->update($request->all());
        return response()->json($categoria);
    }

    public function destroy($id)
    {
        $categoria = categoria::where('user_id', Auth::user()->id)->find($id);
        $categoria->delete();
        return response()->json(null, 204);
    }


}
