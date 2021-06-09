<?php

namespace App\Http\Requests;

use App\Helper\AuthHelper;
use Illuminate\Foundation\Http\FormRequest;

class ProductUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return AuthHelper::checkAdmin();
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
            'price' => 'required|numeric|regex:/^\d+(\.\d{1,2})?$/|max:9999999|min:0.01',
            'slug' => 'required|string|min:10|max:500|unique:products,slug',
            'stock' => 'int|min:0|max:999999999',
            'description' => 'string|min:10|max:1400',
            'active' => 'int|min:0|max:1'
        ];
    }
}
