<?php

namespace App\Http\Controllers\Shop;

use App\Models\Event;
use App\Models\EventPrize;
use App\Modles\EventUser;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class EventUserController extends Controller
{
    //报名
    public function add($id)
    {


        $userId = Auth::user()->id;
        $eventId = $id;
        $event = Event::find($id);
        //找到用户的ID
        $eventUsers=\App\Models\EventUser::where("event_id",$id)->pluck("user_id")->toArray();
        if (in_array($userId,$eventUsers)){
            return redirect()->route("event.detail1",$id)->with("danger","你已经参与过这个活动");
        }

        //找到活动最大人数
        $num = $event->num;
        //如果参与人数小于最大人数
        if ($event->max < $num) {
            \App\Models\EventUser::create(["event_id" => $eventId, "user_id" => $userId]);
            $event->max=$event->max+1;
            $event->save();
            return redirect()->route("event.index1")->with("success","报名成功");
        } else {
            return redirect()->route("event.detail1",$id)->with("danger","参与人数已满");
        }
    }
}
