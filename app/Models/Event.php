<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    //可修改字段
    public $fillable=["title","content","start_time","end_time","num","prize_time"];
}
