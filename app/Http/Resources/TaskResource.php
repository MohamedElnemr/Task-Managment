<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class TaskResource extends JsonResource
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
        return [

            'title' => $this->title,
            'description' => $this->description,
            'image' => $this->image,
            'Title & Description' => $this->title."&".$this->description,
            'Emp_name' => $this->when($this->Employee()->exists(),$this->Employee->name),
        ];
    }
}
