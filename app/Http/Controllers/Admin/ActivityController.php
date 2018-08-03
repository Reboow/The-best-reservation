<?php

namespace App\Http\Controllers\Admin;

use App\Models\Activity;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ActivityController extends BaseController
{
    //添加
    public function add(Request $request)
    {
        if ($request->isMethod("post")){
            $this->validate($request,[
               "title"=>"required",
               "content"=>"required",
            ]);
           $data=$request->post();
           $data["start_time"]=strtotime($data["start_time"]);
            $data["end_time"]=strtotime($data["end_time"]);
            if ($data["end_time"]<$data["start_time"]){
                return back()->withInput()->with("danger","结束时间小于开始时间");
            }
            Activity::create($data);
            return redirect()->route("activity.index")->with("success","添加成功");
        }

        return view("admin.activity.add");
    }

    //首页
    public function index(Request  $request)
    {
        $num=$request->num;
        $query=Activity::orderBy("id");
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

        $activitys=$query->paginate(1);
        return view("admin.activity.index",compact("activitys","arr"));
    }

    //编辑
    public function edit(Request $request,$id)
    {

        $ac=Activity::findOrFail($id);
        if ($request->isMethod("post")){
            $this->validate($request,[
                "title"=>"required",
                "content"=>"required",
            ]);
            $data=$request->post();
            $data["start_time"]=strtotime($data["start_time"]);
            $data["end_time"]=strtotime($data["end_time"]);
            if ($data["end_time"]<$data["start_time"]){
                return back()->withInput()->with("danger","结束时间小于开始时间");
            }
           $ac->update($data);
            return redirect()->route("activity.index")->with("success","添加成功");
        }




        return view("admin.activity.edit",compact("ac"));
    }

    //删除
    public function del(Request $request,$id)
    {
        Activity::destroy($id);
        return redirect()->route("activity.index")->with("success","删除成功");

    }
}
