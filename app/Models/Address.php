<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    //修改的字段
    public $fillable=["name","user_id","tel","provence","city","detail_address","is_default","area"];
}
