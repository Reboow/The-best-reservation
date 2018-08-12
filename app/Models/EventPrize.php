<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EventPrize extends Model
{
    //
    public $fillable=["name","description","event_id"];

    //找到活动
    public function getEvent(){
        return $this->belongsTo(Event::class,"event_id");
    }


    public function getUser(){
        return $this->belongsTo(User::class,"user_id");
    }
}
