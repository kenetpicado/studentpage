<?php

namespace App\Http\Resources\V1;

use Illuminate\Http\Resources\Json\JsonResource;

class MatriculaResource extends JsonResource
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
            'cedula' => $this->cedula,
            'fecha_nac' => $this->fecha_nac,
            'tel' => $this->tel,
            'tutor' => $this->tutor,
            'grado' => $this->grado,
            'carnet' => $this->carnet,
            'sucursal' => $this->sucursal,
            'promotor_id' => $this->promotor_id,
            'created_at' => $this->created_at,
            'promotor' => $this->promotor->carnet,
            'inscrito' => $this->inscrito,
        ];
    }
}
