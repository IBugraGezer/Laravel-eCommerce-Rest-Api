<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductPropertyName extends Model
{
    use HasFactory;

    public function hasPropertyValue() {
        return ProductPropertyValue::where('property_name_id', $this->id)->exists();
    }
}
