<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Storage;

class UploadFileToPublicStorageRequest extends FormRequest
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
            'path' => [
                'required',
                'max:500',
                function($attribute, $value, $fail) {
                    if(Storage::exists("public/$value"))
                        $fail('Filename is already exists.');
                }]
        ];
    }
}
