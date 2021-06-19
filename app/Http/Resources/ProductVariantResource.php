<?php

namespace App\Http\Resources;

use App\Helpers\AuthHelper;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductVariantResource extends JsonResource
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
            'product_id' => $this->product_id,
            'property_value_id' => $this->property_value_id,
            'price' => $this->price,
            'stock' => $this->stock
        ]);
    }
}
