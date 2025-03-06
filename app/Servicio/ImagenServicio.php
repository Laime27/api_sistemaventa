<?php

namespace App\Servicio;

class ImagenServicio
{
    public function subirImagen($imagen, $path)
    {
        $nombreImagen = time() . '.' . $imagen->getClientOriginalExtension();
        $imagen->move(public_path($path), $nombreImagen);
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





