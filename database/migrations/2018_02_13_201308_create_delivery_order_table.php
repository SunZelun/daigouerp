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
            $table->string('logistic_company_name')->nullable();
            $table->string('tracking_number')->nullable();
            $table->string('logistic_status')->nullable();
            $table->string('cost_currency');
            $table->double('cost');
            $table->string('remarks')->nullable();
            $table->integer('shipment_status');
            $table->integer('status');
            $table->timestamps();
        });

        Schema::create('shipment_orders', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('shipment_id');
            $table->integer('order_id');
            $table->string('remarks')->nullable();
            $table->integer('status');
            $table->timestamps();
        });

        Schema::table('orders', function (Blueprint $table) {
            $table->timestamp('order_date')->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->dropColumn('order_date');
        });

        Schema::dropIfExists('shipment_orders');
        Schema::dropIfExists('shipments');
    }
}
