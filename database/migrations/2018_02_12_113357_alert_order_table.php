<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlertOrderTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->string('inter_shipping_currency')->nullable();
            $table->double('inter_shipping_cost')->nullable();
            $table->string('dome_shipping_currency')->nullable();
            $table->double('dome_shipping_cost')->nullable();
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
            $table->dropColumn('dome_shipping_cost');
            $table->dropColumn('dome_shipping_currency');
            $table->dropColumn('inter_shipping_cost');
            $table->dropColumn('inter_shipping_currency');
        });
    }
}
