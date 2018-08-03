<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    //修改字段
    public $fillable=["goods_name","rating","shop_id","category_id","goods_price","description","month_sales","rating_count","tips","satisfy_count","satisfy_rate","goods_img","status"];
    //找到店铺
    public function getShop()
    {
        return $this->belongsTo(Shop::class,"shop_id");
    }
    //找到分类名字
    public function getCate(){
        return $this->belongsTo(MenuCategory::class,"category_id");
    }
}
