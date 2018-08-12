<?php

namespace App\Http\Controllers\Shop;

use App\Models\Event;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class EventController extends BaseController
{
    //抽奖列表

    public function index(Request $request)
        {
            $num=$request->num;
            $query=Event::orderBy("id");
            $arr=$request->query();
            //进行中
            if ($num=="1"){
                $time=time();

                $query->where("start_time","<=",$time);
                $query->where("end_time",">=",$time);
            }
            //未进行
            if ($num=="2"){
                $time=time();
                $query->where("start_time",">=",$time);
            }
            //已经结束
            if ($num=="3"){
                $time=time();
                $query->where("end_time","<=",$time);
            }

            $events=$query->paginate(3);
            return view("shop.event.index",compact("events","arr"));
        }

        //详情
    public function detail($id){
        $event=Event::find($id);
        return view("shop.event.detail",compact("event"));
    }



}
