<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    //可以修改的字段
    public $fillable=["username","password","tel"];
}
