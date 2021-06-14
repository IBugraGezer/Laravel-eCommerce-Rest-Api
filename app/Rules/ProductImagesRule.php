<?php

namespace App\Rules;

use App\Helpers\Helper;
use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Facades\Storage;

class ProductImagesRule implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */

    private $message;
    private $availableImageTypes;

    public function __construct()
    {
        $this->availableImageTypes = config('filesystems.available_image_types');
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
        $images = json_decode($value, true);
        $placeNumbers = [];
        $coverImageCheck = false;

        foreach($images as $image) {
            $placeNumber = $image['place_number'];

            if(is_null($placeNumber) || !is_integer($placeNumber) || $placeNumber <= 0 ) {
                $this->message = "Place number must be a positive integer.";
                return false;
            }
            if($image['is_cover']) {
                if($coverImageCheck) {
                    $this->message = "Only one image can be the cover image.";
                    return false;
                }
                $coverImageCheck = true;
            }

            try {
                $path = $image['path'];
            } catch(\Exception $e) {
                $this->message = "Image path is required.";
                return false;
            }

            if(!is_file("storage/$path")) {
                $this->message = "Image not exists.";
                return false;
            }
            if(!str_contains($path, ".")) {
                $this->message = "Image file must has an extension.";
                return false;
            }

            $extension = pathinfo(public_path("storage/$path"))['extension'];

            if(!in_array($extension, $this->availableImageTypes)) {
                $this->message = "File extension is unavailable.";
                return false;
            }

            array_push($placeNumbers, $image['place_number']);
        }

        if(!Helper::isConsecutive($placeNumbers)) {
            $this->message = "Place numbers must be consecutive.";
            return false;
        } else {
            return true;
        }
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return $this->message;
    }
}
