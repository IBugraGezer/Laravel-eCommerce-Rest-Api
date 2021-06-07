<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'category_id' => 'required|exists:categories',
            'brand_id' => 'required|exists:brands',
            'name' => 'required|string|min:3|max:450',
            'price' => 'required|numeric|min:0.01|max:9999999.99',
            'slug' => 'string|min:10|max:500|unique:products,slug',
            'stock' => 'numeric|min:0|max:999999999',
            'description' => 'string|min:10|max:1400',
            'active' => 'numeric|min:0|max:1'
        ];
    }
}
