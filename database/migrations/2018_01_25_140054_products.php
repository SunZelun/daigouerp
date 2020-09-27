<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Products extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');
            $table->text('name');
            $table->text('description')->nullable();
            $table->float('selling_price_rmb')->nullable();
            $table->float('selling_price_sgd')->nullable();
            $table->float('buying_price_rmb')->nullable();
            $table->float('buying_price_sgd')->nullable();
            $table->double('quantity')->nullable();
            $table->text('remarks')->nullable();
            $table->tinyInteger('status');
            $table->timestamps();
        });

        Schema::create('product_stocks', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('product_id');
            $table->float('quantity');
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
        Schema::dropIfExists('product_stocks');
        Schema::dropIfExists('products');
    }
}
