<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddDefaultMiscTypes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::table('sys_codes')->insert(['code' => '1', 'type' => 'misc_type', 'name' => '换钱', 'status' => 1]);
        DB::table('sys_codes')->insert(['code' => '2', 'type' => 'misc_type', 'name' => '广告费', 'status' => 1]);
        DB::table('sys_codes')->insert(['code' => '3', 'type' => 'misc_type', 'name' => '包装费', 'status' => 1]);
        DB::table('sys_codes')->insert(['code' => '4', 'type' => 'misc_type', 'name' => '员工福利', 'status' => 1]);
        DB::table('sys_codes')->insert(['code' => '5', 'type' => 'misc_type', 'name' => '其它', 'status' => 1]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::table('sys_codes')->where(['code' => '1', 'type' => 'misc_type'])->delete();
        DB::table('sys_codes')->where(['code' => '2', 'type' => 'misc_type'])->delete();
        DB::table('sys_codes')->where(['code' => '3', 'type' => 'misc_type'])->delete();
        DB::table('sys_codes')->where(['code' => '4', 'type' => 'misc_type'])->delete();
        DB::table('sys_codes')->where(['code' => '5', 'type' => 'misc_type'])->delete();
    }
}
