<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\proveedores;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class proveedorController extends Controller
{
    public function index()
    {
        $proveedores = proveedores::where('user_id', Auth::user()->id)->get();
        return response()->json($proveedores);
    }       
    
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'correo' => 'nullable|email|' . Rule::unique('proveedores')->where('user_id', Auth::id()),
            
        ]);

        $request['user_id'] = Auth::user()->id;

        $proveedor = proveedores::create($request->all());
        return response()->json($proveedor);
    }
    

    public function show($id)
    {
        $proveedor = proveedores::where('user_id', Auth::user()->id)->find($id);
        return response()->json($proveedor);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'correo' => 'nullable|email|' . Rule::unique('proveedores')->where('user_id', Auth::id()),
        ]);

        $proveedor = proveedores::where('user_id', Auth::user()->id)->find($id);

        $proveedor->update($request->all());
        return response()->json($proveedor);
    }
    
    public function destroy($id)
    {
        $proveedor = proveedores::where('user_id', Auth::user()->id)->find($id);
        $proveedor->delete();
        return response()->json(null, 204);
    }   
    
    
    



}
