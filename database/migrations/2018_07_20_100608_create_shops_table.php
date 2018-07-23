<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateShopsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shops', function (Blueprint $table) {
            $table->increments('id');
            $table->integer("shop_category_id")->comment("商铺分类ID");
            $table->string("shop_name")->comment("商铺名字");
            $table->string("img")->comment("商铺图片");
            $table->float("rating")->comment("评分");
            $table->integer("brand")->comment("是否品牌");
            $table->integer("on_time")->comment("是否准时送达");
            $table->integer("fengniao")->comment("是否蜂鸟");
            $table->integer("bao")->comment("是否保");
            $table->integer("piao")->comment("是否票");
            $table->integer("zhun")->comment("是否准");
            $table->decimal("start_send")->comment("起送费");
            $table->string("notice")->comment("店公告");
            $table->string("discount")->comment("优惠信息");
            $table->integer("status")->comment("状态信息，0待审核,1正常,-1禁用");
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
        Schema::dropIfExists('shops');
    }

}
