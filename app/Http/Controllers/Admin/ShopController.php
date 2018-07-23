<?php

namespace App\Http\Controllers\Admin;

use App\Models\Shop;
use App\Models\ShopCategory;
use App\models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class ShopController extends BaseController
{
    //首页
    public function index()
    {
       $users=User::paginate(3);
       return view("Admin.Shop.index",compact("users"));
    }


    public function update(Request $request,$id){
        $shop=Shop::find($id);
        $shop->status=1;
        $shop->save();
        $request->session()->flash("success","修改成功");
        return redirect()->route("shop.index");
    }
    public function status(Request $request,$id){
        $shop=Shop::find($id);
        $shop->status=-$shop->status;
        $shop->save();
        $request->session()->flash("success","修改成功");
        return redirect()->route("shop.index");
    }
    public function add(Request $request){
        //判断是否POST提交
        if ($request->isMethod("post")){
            $this->validate($request,[
               "name"=>"required",
                "email"=>"required",
                "password"=>"required",
                "shop_name"=>"required",
                "img"=>"required",
                "rating"=>"required",
                "brand"=>"required",
                "on_time"=>"required",
                "fengniao"=>"required",
                "bao"=>"required",
                "piao"=>"required",
                "zhun"=>"required",
                "start_send"=>"required",
                "notice"=>"required",
                "discount"=>"required",
                "send_cost"=>"required"
            ]);




            $data=$request->all();
            $data["password"]=bcrypt($data["password"]);
            $img=$request->file("img")->store("shop","img");
            $data["img"]=$img;
            $data["status"]=1;
            //开启事务
            DB::transaction(function () use($data){
                $shop=Shop::create($data);
                $data["shop_id"]=$shop->id;
                User::create($data);
            });
            $request->session()->flash("success","添加成功");
            return redirect()->route("shop.index");
        }
        $cates=ShopCategory::where("status","=","1")->get();
        return view("admin.shop.add",compact("cates"));


    }

    //编辑
    public function edit(Request $request,$id)
    {
        $user=User::find($id);
        $shop=Shop::find($user->shop_id);

        //判断是否有POST上传
        if ($request->isMethod("post")){
            $data=$request->all();
            $data["img"]=$shop->img;
            //判断是否有图片上传
            if($request->file("img")){
                $data["img"]=$request->file("img")->store("shop","img");
            }
            //开始事务
            DB::transaction(function () use ($data,$shop,$user){
               $shop->update($data);
                $user->update($data);
            });
            $request->session()->flash("success","编辑成功");
            return redirect()->route("shop.index");
        }

        $cates=ShopCategory::all();
        return view("admin.shop.edit",compact("cates","shop","user"));
    }

    //删除
    public function del(Request $request,$id)
    {
        $user=User::find($id);
        $shop=Shop::find($user->shop_id);
        DB::transaction(function () use ($user,$shop){
            $user->delete();
            $shop->delete();
        });
        $request->session()->flash("success","删除成功");
        return redirect()->route("shop.index");
    }

    //重置密码
    public function reset(Request $request,$id){
        $user=User::find($id);
        $password=bcrypt("0000");
        $user->password=$password;
        if ($user->save()) {
            $request->session()->flash("success","重置成功");
            return redirect()->route("shop.index");
        }
        $request->session()->flash("danger","重置失败");
        return redirect()->route("shop.index");


    }
}
