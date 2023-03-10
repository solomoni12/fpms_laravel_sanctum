<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class LaborResource extends JsonResource
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
            'id' => (string)$this->id,
            'attributes' => [
                'name'=> $this->name,
                'labor_cost' => $this->labor_cost,
                'created_at' => $this->created_at,
                'updated_at' => $this->updated_at
            ],
            'relationships'=>[
                'id' => (string)$this->user->id,
                'user name' => $this->user->name,
                'user email'=> $this->user->email
            ],
            'relationship_field'=>[
                'id' => (string)$this->field->id,
                'field location' => $this->field->location,
                'field size' => $this->field->size
            ]
        ];
    }
}
