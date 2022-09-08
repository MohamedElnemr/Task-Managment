<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ManagerResource extends JsonResource
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
            // Relation Manager with User
            'Name' => $this->when($this->User()->exists(), $this->User->name),
            'email' => $this->when($this->User()->exists(),$this->User->email),
            'gendr' => $this->when($this->User()->exists(),$this->User->gender),
            'user_type' => $this->when($this->User()->exists(),$this->User->user_type),
            'profile_photo_path' => $this->when($this->User()->exists(),$this->User->profile_photo_path),
            'current_team_id' => $this->when($this->User()->exists(),$this->User->current_team_id),


            // Manager
            'section' => $this->section,
            'join_date' => $this->join_date,
        ];
    }
}
