<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MenuCategory extends Model
{
    //可以修改的字段
    public $fillable=["name","shop_id","description","type_accumulation","is_selected"];

    //找出店铺名字
    public function getShop(){
        return $this->belongsTo(Shop::class,"shop_id");
    }
}
