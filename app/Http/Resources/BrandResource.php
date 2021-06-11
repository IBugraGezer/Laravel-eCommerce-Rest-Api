<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Helpers\AuthHelper;

class BrandResource extends JsonResource
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
            'name' => $this->name,
            'active' => AuthHelper::checkAdmin() ? $this->active : null,
        ]);
    }
}
