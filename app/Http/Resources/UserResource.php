<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
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
            "id" => $this->when(Auth('sanctum')->check() && Auth('sanctum')->user()->tokenCan('admin'), $this->id),
            "name" => $this->name,
            "email" => $this->email,
            "last_ip" => $this->when(Auth('sanctum')->check() && Auth('sanctum')->user()->tokenCan('admin'), $this->last_ip),
            "register_ip" => $this->when(Auth('sanctum')->check() && Auth('sanctum')->user()->tokenCan('admin'), $this->register_ip),
        ];
    }
}
