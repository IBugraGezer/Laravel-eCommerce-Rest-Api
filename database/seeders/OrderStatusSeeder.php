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
            'status' => 'incomplete'
        ]);

        OrderStatus::create([
            'status' => 'pending'
        ]);

        OrderStatus::create([
            'status' => 'cancelled'
        ]);

        OrderStatus::create([
            'status' => 'awaiting shipment'
        ]);

        OrderStatus::create([
            'status' => 'shipped'
        ]);

        OrderStatus::create([
            'status' => 'complete'
        ]);

        OrderStatus::create([
            'status' => 'refunded'
        ]);
    }
}
