<?php

namespace App\Services;

class Imagenes
{
    public function get()
    {
        $imagenes = [];
        $path = '../public/courses';
        $dir = opendir($path);

        while ($elemento = readdir($dir)) {
            if (!in_array($elemento, ['.', '..']))
                array_push($imagenes, ['nombre' => $elemento]);
        }
        closedir($dir);
        return collect($imagenes)->sortBy('nombre');
    }
}
