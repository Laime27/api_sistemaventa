<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\clientes;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
class clienteController extends Controller
{
    public function index()
    {
        $clientes = clientes::where('user_id', Auth::user()->id)->get();
        return response()->json($clientes);
    }
    
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'correo' => 'nullable|email|' . Rule::unique('clientes')->where('user_id', Auth::id()),
        ]);

        $request['user_id'] = Auth::user()->id;

        $cliente = clientes::create($request->all());
        return response()->json($cliente);  
        
        }

    public function show($id)
    {
        $cliente = clientes::where('user_id', Auth::user()->id)->find($id);
        return response()->json($cliente);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'correo' => 'nullable|email|' . Rule::unique('clientes')->where('user_id', Auth::id()),
        ]);

        $cliente = clientes::where('user_id', Auth::user()->id)->find($id);
        $cliente->update($request->all());
        return response()->json($cliente);
    }

    public function destroy($id)
    {
        $cliente = clientes::where('user_id', Auth::user()->id)->find($id);
        $cliente->delete();
        return response()->json(null, 204);
    }
    
}
