<?php

namespace App\Http\Resources\V1;

use Illuminate\Http\Resources\Json\JsonResource;

class InscripcionResource extends JsonResource
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
            'grupo_id' => $this->grupo_id,
            'matricula_id' => $this->matricula_id,
            'docente' => $this->grupo->docente->carnet,
            'horario' => $this->grupo->horario,
            'curso' => $this->grupo->curso->nombre,
            'carnet_est' => $this->matricula->carnet,
        ];
    }
}
