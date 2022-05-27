<?php

namespace App\Http\Resources\V1;

use Illuminate\Http\Resources\Json\JsonResource;

class NotaResource extends JsonResource
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
            'unidad' => $this->unidad,
            'valor' => $this->valor,
            'inscripcion_id' => $this->inscripcion_id,
            'docente' => $this->inscripcion->grupo->docente->carnet,
            'horario' => $this->inscripcion->grupo->horario,
            'curso' => $this->inscripcion->grupo->curso->nombre,
            'carnet_est' => $this->inscripcion->matricula->carnet,
            'created_at' => $this->created_at,
        ];
    }
}
