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
            $table->string('cost_in_rmb')->nullable();
            $table->double('cost_in_sgd')->nullable();
            $table->string('revenue_in_rmb')->nullable();
            $table->double('revenue_in_sgd')->nullable();
            $table->string('profit_in_rmb')->nullable();
            $table->double('profit_in_sgd')->nullable();
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
            $table->string('selling_currency')->nullable();
            $table->double('selling_price')->nullable();
            $table->string('buying_currency')->nullable();
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
