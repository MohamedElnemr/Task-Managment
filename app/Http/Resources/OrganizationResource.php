<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class OrganizationResource extends JsonResource
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
            //key of return => key of object
            'name' => $this->name,
            'description' => $this->description,
            'status' => $this->status,
            'manager_id' => $this->manager_id
            // 'date_of_birth'=>$this->date_of_birth,
            // 'organization_name' => $this->when($this->Organization()->exists(),$this->Organization->name),
            // 'organization_description' => $this->when($this->Organization()->exists(),$this->Organization->description),
        ];
    }
}
