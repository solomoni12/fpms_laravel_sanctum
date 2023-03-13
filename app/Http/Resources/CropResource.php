<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CropResource extends JsonResource
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
                'crop_type'=> $this->crop_type,
                'planting_date' => $this->planting_date,
                'harvest_date' => $this->harvest_date,
                'created_at' => $this->created_at,
                'updated_at' => $this->updated_at
            ],
            'relationships'=>[
                'id' => (string)$this->field->id,
                'name' => $this->field->name,
                'location'=> $this->field->location,
                'size' => $this->field->size
            ],
            // 'relationships user' =>[
            //     'id' => (string)$this->user->id,
            //     'user name' => $this->user->name,
            //     'user email' => $this->user->email
            // ]
        ];
    }
}
