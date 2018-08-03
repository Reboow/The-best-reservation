<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Shop extends Model
{
    //可以修改的字段
    public $fillable=["shop_name","shop_img","shop_rating","brand","on_time","fengniao","bao","piao","zhun","start_send","notice","discount","shop_category_id","status","send_cost"];
    //找到店铺类别
    public function cate(){
        return $this->belongsTo(ShopCategory::class,"shop_category_id");
    }
}
