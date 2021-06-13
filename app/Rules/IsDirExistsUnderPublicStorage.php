<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class IsDirExistsUnderPublicStorage implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        return is_dir(public_path("storage" . DIRECTORY_SEPARATOR . $value));
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'This directory is not exists.';
    }
}
