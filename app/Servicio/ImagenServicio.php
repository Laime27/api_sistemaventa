<?php

namespace App\Servicio;
use Illuminate\Support\Facades\Storage;

class ImagenServicio
{
    public function subirImagen($imagen, $path)
    {
        $nombreImagen = str_replace(' ', '_', $imagen->getClientOriginalName());
        $imagen->storeAs($path, $nombreImagen, 'public');
        return $nombreImagen;  
    }

    public function eliminarImagen($imagen, $path)
    {
        if ($imagen) {
            $imagenPath = public_path($path . $imagen);
            if (file_exists($imagenPath)) {
                unlink($imagenPath);
            }
        }   
    }
}




