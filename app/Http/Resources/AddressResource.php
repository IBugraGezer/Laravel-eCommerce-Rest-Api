<?php

namespace App\Http\Resources;

use App\Helper\AuthHelper;
use Illuminate\Http\Resources\Json\JsonResource;

class AddressResource extends JsonResource
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
            'id' => AuthHelper::checkAdmin() ? $this->id : null,
            'user_id' => AuthHelper::checkAdmin() ? $this->user_id : null,
            'address_name' => $this->address_name,
            'address' => $this->address,
        ]);
    }
}
