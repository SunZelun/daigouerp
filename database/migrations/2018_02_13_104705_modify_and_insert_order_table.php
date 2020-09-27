<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ModifyAndInsertOrderTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->string('order_status')->default(10);
        });

        DB::table('sys_codes')->insert(['code' => '10', 'type' => 'order_status', 'name' => '待发货', 'status' => 1]);
        DB::table('sys_codes')->insert(['code' => '20', 'type' => 'order_status', 'name' => '国际运输中', 'status' => 1]);
        DB::table('sys_codes')->insert(['code' => '30', 'type' => 'order_status', 'name' => '已入库', 'status' => 1]);
        DB::table('sys_codes')->insert(['code' => '40', 'type' => 'order_status', 'name' => '国内已发货', 'status' => 1]);
        DB::table('sys_codes')->insert(['code' => '50', 'type' => 'order_status', 'name' => '已送达', 'status' => 1]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->dropColumn('order_status');
        });

        DB::table('sys_codes')->where(['code' => '10', 'type' => 'order_status'])->delete();
        DB::table('sys_codes')->where(['code' => '20', 'type' => 'order_status'])->delete();
        DB::table('sys_codes')->where(['code' => '30', 'type' => 'order_status'])->delete();
        DB::table('sys_codes')->where(['code' => '40', 'type' => 'order_status'])->delete();
        DB::table('sys_codes')->where(['code' => '50', 'type' => 'order_status'])->delete();
    }
}
