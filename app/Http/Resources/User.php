<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class User extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'username' => $this->username,
            'mobile' => $this->mobile,
            'email' => $this->email,
            'no_of_post' => $this->no_of_post,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
