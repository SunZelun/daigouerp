<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Orders extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');
            $table->integer('customer_id');
            $table->integer('customer_address_id')->nullable();
            $table->string('cost_currency')->nullable();
            $table->double('total_cost')->nullable();
            $table->string('amount_currency')->nullable();
            $table->double('total_amount')->nullable();
            $table->string('profit_currency')->nullable();
            $table->double('total_profit')->nullable();
            $table->string('remarks')->nullable();
            $table->integer('status');
            $table->timestamps();
        });

        Schema::create('order_payments', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('order_id');
            $table->integer('payment_type');
            $table->string('amount_currency');
            $table->double('amount');
            $table->string('remarks')->nullable();
            $table->tinyInteger('status');
            $table->timestamps();
        });

        Schema::create('order_products', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('order_id');
            $table->integer('product_id');
            $table->double('quantity')->nullable();
            $table->string('selling_price_currency')->nullable();
            $table->double('selling_price')->nullable();
            $table->string('buying_price_currency')->nullable();
            $table->double('buying_price')->nullable();
            $table->text('remarks')->nullable();
            $table->tinyInteger('status');
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
        Schema::dropIfExists('order_products');
        Schema::dropIfExists('order_payments');
        Schema::dropIfExists('orders');
    }
}
