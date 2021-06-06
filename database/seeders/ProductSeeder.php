<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Product::create([
            'category_id' => 1,
            'brand_id' => 1,
            'name' => "test product",
            'cover_image' => null,
            'price' => 1500,
            'slug' => "test slug",
            'serial_number' => 123456,
            'stock' => 50,
            'description' => "test description text",
            'rating_average' => null,
            'active' => 1,
        ]);
    }
}
