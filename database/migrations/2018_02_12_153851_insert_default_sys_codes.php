<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class InsertDefaultSysCodes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::table('sys_codes')->insert(['code' => 'brand', 'type' => 'type', 'name' => '品牌/Brand', 'status' => 1]);
        DB::table('sys_codes')->insert(['code' => 'category', 'type' => 'type', 'name' => '类别/Category', 'status' => 1]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
