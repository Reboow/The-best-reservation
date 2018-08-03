<?php

namespace App\Http\Controllers\Shop;

use App\Models\Activity;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ActivityController extends BaseController
{
    //首页
    public function index()
    {
        $time=time();
        $activitys=Activity::where("end_time",">=",$time)->paginate(1);
        return view("shop.activity.index",compact("activitys"));
    }
}
