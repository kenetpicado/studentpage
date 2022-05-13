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
            'sucursal' => $this->sucursal,
            'curso_id' => $this->curso_id,
            'docente_id' => $this->docente_id,
              
            'created_at' => $this->created_at,
       ];
    }
}
