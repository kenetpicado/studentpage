<?php

namespace App\Classes;

class Items
{
    public $id;
    public $nombre;

    public function __construct($nombre, $id = null)
    {
        $this->id = $id == null ? $nombre : $id;
        $this->nombre = $nombre;
    }
}
