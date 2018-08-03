<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    //
    public $fillable=["user_id","shop_id","name","provence","city","area","detail_address","tel","sn","total","status"];


    //设置状态
    public function getOrderStatusAttribute()
    {
        $arr=["-1"=>"已取消","0"=>"代付款","1"=>"待发货","2"=>"待确认","3"=>"完成"];
        return $arr[$this->status];

    }

}
