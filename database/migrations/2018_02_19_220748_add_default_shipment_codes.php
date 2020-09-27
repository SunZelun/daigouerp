<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddDefaultShipmentCodes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::table('sys_codes')->insert(['code' => '1', 'type' => 'shipment_type', 'name' => '国际运输', 'status' => 1]);
        DB::table('sys_codes')->insert(['code' => '2', 'type' => 'shipment_type', 'name' => '国内运输', 'status' => 1]);


        DB::table('sys_codes')->insert(['code' => '10', 'type' => 'shipment_status', 'name' => '已发货', 'status' => 1]);
        DB::table('sys_codes')->insert(['code' => '20', 'type' => 'shipment_status', 'name' => '已送达', 'status' => 1]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::table('sys_codes')->where(['code' => '1', 'type' => 'shipment_type'])->delete();
        DB::table('sys_codes')->where(['code' => '2', 'type' => 'shipment_type'])->delete();
        DB::table('sys_codes')->where(['code' => '10', 'type' => 'shipment_status'])->delete();
        DB::table('sys_codes')->where(['code' => '20', 'type' => 'shipment_status'])->delete();
    }
}
