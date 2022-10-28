<?php

namespace App\Http\Resources\matricula;

use Illuminate\Http\Resources\Json\JsonResource;

class MatriculaIndex extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        //return parent::toArray($request);
    
        return[
            'id' => $this->id,
            'nombre' => $this->nombre,
            'carnet' => $this->carnet,
        ]; 
    }
}
