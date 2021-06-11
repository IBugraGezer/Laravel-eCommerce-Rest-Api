<?php

namespace App\Http\Resources;

use App\Helpers\AuthHelper;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
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
            'category' => $this->category->name,
            'brand' => $this->brand->name,
            'name' => $this->name,
            'price' => $this->price,
            'slug' => $this->slug,
            'serial_number' => $this->serial_number,
            'stock' => $this->stock,
            'description' => $this->description,
            'rating_average' => $this->rating_average,
            'active' => AuthHelper::checkAdmin() ? $this->active : null
        ]);
    }
}
