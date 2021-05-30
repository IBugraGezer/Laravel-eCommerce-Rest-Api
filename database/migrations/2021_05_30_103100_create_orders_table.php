<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('status');
            $table->string('delivery_address_id',400);
            $table->string('billing_address_id', 400);
            $table->unsignedFloat('total_price', 7, 2);
            $table->string('ship_tracking_code', 100)->nullable();
            $table->unsignedBigInteger('shipping_company_id')->nullable();
            $table->string('order_code', 100);
            $table->boolean('active')->default(1);
            $table->timestamps();

            $table->foreign('status')
                ->references('id')
                ->on('order_statuses');

            $table->foreign('delivery_address_id')
                ->references('id')
                ->on('addresses');

            $table->foreign('billing_address_id')
                ->references('id')
                ->on('addresses');

            $table->foreign('shipping_company_id')
                ->references('id')
                ->on('shipping_companies');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders');
    }
}
