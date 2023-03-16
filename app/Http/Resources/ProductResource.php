<?php

namespace App\Http\Resources;

use App\Models\Field;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
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
                    'quantity' => $this->quantity,
                    'created_at' => $this->created_at,
                    'updated_at' => $this->updated_at
                ],
                 'relationships'=>[
                    'id' => (string)$this->user->id,
                     'user name' => $this->user->name,
                   'user email'=> $this->user->email
                 ],
                 'relationships field'=>[
                    'id' => (string)$this->field->id,
                    'field name' => $this->field->name,
                   'field location'=> $this->field->location
                 ]
            ];
        
    }
}
