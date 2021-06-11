<?php

namespace App\Http\Resources;

use App\Helpers\AuthHelper;
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
        return array_filter([
            "id" => AuthHelper::checkAdmin() ? $this->id : null,
            "name" => $this->name,
            "email" => $this->email,
            "last_ip" => AuthHelper::checkAdmin() ? $this->last_ip : null,
            "register_ip" => AuthHelper::checkAdmin() ? $this->register_ip : null,
        ]);
    }
}
