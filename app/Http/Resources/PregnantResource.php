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
            'fecha_de_nacimiento' => Carbon::parse($this->fecha_de_nacimiento)->format('d-m-Y'),
            'tipo_de_examen' => $this->tipo_de_examen,
            'ultima_regla' => Carbon::parse($this->ultima_regla)->format('d-m-Y'),
            'peso' => $this->peso,
            'cmb' => $this->cmb,
            'altura' => $this->altura,
            'id_user' => (String) $this->id_user,
            'user_name' => $this->user ? $this->user->name : '',
            // 'user' => new UserResource($this->user),
            // 'created_at' => (string) $this->created_at,
            'created_at' => Carbon::parse($this->created_at)->format('d-m-Y'),
            'updated_at' => Carbon::parse($this->updated_at)->format('d-m-Y'),
        ];
    }
}
