<?php

namespace App\Http\Resources\V1;

use Illuminate\Http\Resources\Json\JsonResource;

class GrupoResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
       // return parent::toArray($request);
       return[
            'id' => $this->id,
            'notificacion' => $this->notificacion,
            'horario' => $this->horario,
            'anyo' => $this->anyo,
            'sucursal' => $this->sucursal,
            'activo' => $this->activo,
            'curso_id' => $this->curso_id,
            'docente_id' => $this->docente_id,
            'curso' => $this->curso->nombre,
            'docente' => $this->docente->carnet,
            'created_at' => $this->created_at,
       ];
    }
}
