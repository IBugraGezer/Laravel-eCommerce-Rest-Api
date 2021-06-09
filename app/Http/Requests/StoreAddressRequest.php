<?php

namespace App\Http\Requests;

use App\Helper\AuthHelper;
use App\Models\Address;
use Illuminate\Foundation\Http\FormRequest;

class StoreAddressRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return AuthHelper::checkLogin();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'address_name' => 'required|string|max:70',
            'address' => 'required|string|min:10|max:450',
            'active' => 'int|min:0|max:1'
        ];
    }
}
