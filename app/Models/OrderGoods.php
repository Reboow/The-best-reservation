<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderGoods extends Model
{
    //可以修改的字段
    public $fillable=["goods_name","goods_price","goods_img","amount","order_id","goods_id"];
}
