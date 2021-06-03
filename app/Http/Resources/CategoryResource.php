<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Models\User;

class CategoryResource extends JsonResource
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
            "active" => $this->when(Auth('sanctum')->check() && Auth('sanctum')->user()->tokenCan('admin'), $this->active)
        ];
    }
}
