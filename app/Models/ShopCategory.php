<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ShopCategory extends Model
{
    //可以修改的字段
    public $fillable=["name","intro","status","logo"];
}
