<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Carbon\Carbon;

class PregnantResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */

    public function toArray($request)
    {

        return [
            'id' => $this->id,
            'cui' => $this->cui,
            'nombres' => $this->nombres,
            'apellidos' => $this->apellidos,
            'direccion' => $this->direccion,
            'fecha_de_nacimiento' => $this->fecha_de_nacimiento,
            'ultima_regla' => $this->ultima_regla,
            'peso' => $this->peso,
            'altura' => $this->altura,
            'id_user' => (String) $this->id_user,
            // 'user' => $this->user->name !== null ? $this->user->name : '', 
            // 'user' => new UserResource($this->user),
            // 'created_at' => (string) $this->created_at,
            'created_at' => Carbon::parse($this->created_at)->format('Y-m-d'),
            'updated_at' => Carbon::parse($this->updated_at)->format('Y-m-d'),
        ];
    }
}
