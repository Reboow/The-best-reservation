<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    //可以修改的字段
    public $fillable=["title","start_time","end_time","content"];
}
