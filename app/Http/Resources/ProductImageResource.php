<?php

namespace App\Http\Resources;

use App\Helpers\AuthHelper;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductImageResource extends JsonResource
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
            'product_id' => AuthHelper::checkAdmin() ? $this->product_id : null,
            'image_path' => $this->image_path,
            'place_number' => $this->place_number,
            'is_cover' => $this->is_cover
        ]);
    }
}
