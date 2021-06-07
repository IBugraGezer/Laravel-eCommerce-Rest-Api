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
            'category_id' => 'required|exists:categories,id',
            'brand_id' => 'required|exists:brands,id',
            'name' => 'required|string|min:3|max:450',
            'price' => 'required|numeric|regex:/^\d+(\.\d{7,2})?$/',
            'slug' => 'string|min:10|max:500|unique:products,slug',
            'stock' => 'int|min:0|max:999999999',
            'description' => 'string|min:10|max:1400',
            'active' => 'int|min:0|max:1'
        ];
    }
}
