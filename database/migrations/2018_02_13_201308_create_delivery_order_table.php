<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDeliveryOrderTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shipments', function (Blueprint $table) {
            $table->increments('id');
            $table->dateTime('ship_date');
            $table->integer('type');
            $table->string('tracking_number');
            $table->string('cost_currency');
            $table->double('cost');
            $table->string('remarks');
            $table->integer('shipment_status');
            $table->integer('status');
            $table->timestamps();
        });

        Schema::create('shipment_orders', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('shipment_id');
            $table->integer('order_id');
            $table->string('remarks');
            $table->integer('status');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('shipment_orders');
        Schema::dropIfExists('shipments');
    }
}
