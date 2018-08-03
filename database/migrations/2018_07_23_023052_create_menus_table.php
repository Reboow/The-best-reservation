<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMenusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('menus', function (Blueprint $table) {
            $table->increments('id');
            $table->string("goods_name")->comment("菜品名字");
            $table->float("rating")->comment("菜品评分");
            $table->integer("shop_id")->comment("所属商铺");
            $table->integer("category_id")->comment("所属分类");
            $table->decimal("goods_price")->comment("菜品价格");
            $table->string("description")->comment("菜品描述");
            $table->integer("month_sales")->comment("月销量");
            $table->integer("rating_count")->comment("评分数量");
            $table->string("tips")->comment("提示信息");
            $table->integer("satisfy_count")->comment("满意度数量");
            $table->float("satisfy_rate")->comment("满意度评分");
            $table->string("goods_img")->comment("菜品图片");
            $table->integer("status")->comment("1是上架，0是下架");
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
        Schema::dropIfExists('menus');
    }
}
