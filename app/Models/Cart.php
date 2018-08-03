<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    //可以修改的字段
    public  $fillable=["user_id","goods_id","amount"];

    //找到商品
    public function getGoods(){
        return $this->belongsTo(Menu::class,"goods_id");

    }
}
