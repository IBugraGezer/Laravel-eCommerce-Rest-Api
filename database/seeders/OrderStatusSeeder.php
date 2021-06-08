<?php

namespace Database\Seeders;

use App\Models\OrderStatus;
use Illuminate\Database\Seeder;

class OrderStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        OrderStatus::create([
            'status' => 'awaiting payment'
        ]);

        OrderStatus::create([
            'status' => 'packing'
        ]);

        OrderStatus::create([
            'status' => 'shipping'
        ]);

        OrderStatus::create([
            'status' => 'shipped'
        ]);

        OrderStatus::create([
            'status' => 'delivered'
        ]);

        OrderStatus::create([
            'status' => 'cancelled'
        ]);
    }
}
