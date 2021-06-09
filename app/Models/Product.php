<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $guarded = ['serial_number', 'rating_average', 'id'];

    public function category() {
        return $this->belongsTo(Category::class);
    }

    public function brand() {
        return $this->belongsTo(Brand::class);
    }

    public function generateProductSerialNumber() {
        $chars = '1234567890ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $serialNumber = substr(str_shuffle($chars), 0, 8);

        $this->serial_number = $serialNumber;
    }

}
