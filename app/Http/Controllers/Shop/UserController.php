<?php

namespace App\Http\Controllers\Shop;

use App\Models\Shop;
use App\Models\ShopCategory;
use App\models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    //注册
    public function reg(Request $request){
        //判断是否POST提交
        if ($request->isMethod("post")){
            $data=$request->all();
            $data["password"]=bcrypt($data["password"]);
            $img=$request->file("img")->store("shop","img");
            $data["img"]=$img;
            //开启事务
            DB::transaction(function () use($data){
                $shop=Shop::create($data);
                $data["shop_id"]=$shop->id;
                User::create($data);
            });
        }
        $cates=ShopCategory::where("status","=","1")->get();
        return view("shop.user.reg",compact("cates"));
    }
    public function login(Request $request){
        if ($request->isMethod("post")){
            $this->validate($request,[
                "name"=>"required",
                "password"=>"required",
            ]);
            if(Auth::attempt(["name"=>$request->post("name"),"password"=>$request->post("password")],$request->has("remember"))){
                return redirect()->route("user.index");
            }else{
                $request->session()->flash("danger","用户或者密码错误");
                return redirect()->route("user.login");
            }

        }
        if ($request->isMethod("post")){


        }

        return view("shop.user.login");
    }

    public function index(Request $request){
       $id=Auth::user()->id;
      $user=User::find($id);

      return view("shop.user.index",compact("user"));
    }

    //编辑
    public function edit(Request $request,$id){
        $user=User::find($id);
        $shop=Shop::find($user->shop_id);
        $cates=ShopCategory::all();
        if ($request->isMethod("post")){
            $this->validate($request,[
                "name"=>"required|unique:users,name,$id",
                "email"=>"required|unique:users,email,$id",
                "shop_name"=>"required|unique:shops,shop_name,$id",
                "shop_rating"=>"required",
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
            $data["shop_img"]=$shop->img;
            //判断是否有图片上传
            if($request->file("shop_img")){
                $data["shop_img"]=$request->file("shop_img")->store("shop","img");
            }
            //开启事务
            DB::transaction(function () use ($shop,$user,$data){
                $shop->update($data);
                $user->update($data);
            });
            $request->session()->flash("success","编辑成功");
            return redirect()->route("user.index");
        }

        return view("shop.user.edit",compact("user","cates","shop"));
    }

    //修改密码
    public function pass(Request $request,$id){

        $user=user::find($id);
        if ($request->isMethod("post")) {
            $password = $request->post("old_password");
            if (Hash::check($password, $user->password)) {

                $this->validate($request, [
                    "password" => "confirmed|required",
                ]);
                $data = $request->post();
                $data["password"] = bcrypt($data["password"]);
                $user->update($data);
                $request->session()->flash("success", "修改成功");
                return redirect()->route("user.index");
            } else {
                $request->session()->flash("danger", "旧密码错误");
                return redirect()->back()->withInput();
            }
        }
        return view("shop.user.pass");
    }

    //退出登录
    public function loginout()
    {
        Auth::logout();
        return redirect()->route("user.login");
    }
}
