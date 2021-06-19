<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductVariantUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'product_id' => 'required|exists:products,id',
            'property_value_id' => 'required|exists:product_property_values,id',
            'price' => 'required|numeric|regex:/^\d+(\.\d{1,2})?$/|max:9999999|min:0.01',
            'stock' => 'int|min:0|max:999999999',
        ];
    }
}
