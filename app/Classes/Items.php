<?php

namespace App\Classes;

class Items
{
    public $id;
    public $nombre;

    public function __construct($id)
    {
        $this->nombre = $id;
        $this->id = $id;
    }
}
