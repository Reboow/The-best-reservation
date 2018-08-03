<?php

namespace App\Http\Controllers\Admin;

use App\Models\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AdminController extends BaseController
{
    //添加
    public function add(Request $request)
    {
        //判断POST提交
        if($request->isMethod("post")){
            $this->validate($request,[
                "name"=>"required",
                "password"=>"required|confirmed",
                "email"=>"required"
            ]);
            $data=$request->post();
            $data["password"]=bcrypt($data["password"]);
            Admin::create($data);
            $request->session()->flash("sucees","提交成功");
            return redirect()->route("admin.index");
        }


        return view("admin.admin.add");
    }
    //编辑
    public function edit(Request $request,$id){
        $admin=Admin::find($id);
        if ($request->isMethod("post")){
            $this->validate($request,[
                "name"=>"required|unique:admins,name,$admin->id",
                "password"=>"required|confirmed",
                "email"=>"required"
            ]);
            $password=$request->post("old_password");

            if (Hash::check($password,$admin->password)) {
                $data=$request->post();
                $data["password"]=bcrypt($data["password"]);
                $admin->update($data);
                $request->session()->flash("success","修改成功");
                return redirect()->route("admin.index");
            }else{
                $request->session()->flash("danger","旧密码错误");
                return redirect()->back()->withInput();
            }


        }


        return view("admin.admin.edit",compact("admin"));
    }

    public function login(Request $request)
    {
        if ($request->isMethod("post")){
            $this->validate($request,[
                "name"=>"required",
                "password"=>"required",
            ]);
            if(Auth::guard("admin")->attempt(["name"=>$request->post("name"),"password"=>$request->post("password")],$request->has("remember"))){
                return redirect()->route("shop.index");
            }else{
                 $request->session()->flash("danger","用户或者密码错误");
                 return redirect()->route("admin.login");
            }

        }

        return view("admin.admin.login");
    }

    //注销
    public function loginout(){
        Auth::guard("admin")->logout();
        return redirect()->route("admin.login");
    }

    public function update(Request $request,$id)
    {
        $Admin=Admin::find($id);
        if ($request->isMethod("post")){
            $password=$request->post("old_password");

            if (Hash::check($password,$Admin->password)) {
                $this->validate($request,[
                   "password"=>"confirmed|required",
                ]);
                $data=$request->post();
                $data["password"]=bcrypt($data["password"]);
                $Admin->update($data);
                $request->session()->flash("success","修改成功");
                return redirect()->route("admin.index");
            }else{
                $request->session()->flash("danger","旧密码错误");
                return redirect()->back()->withInput();
            }

        }

        return view("admin.admin.update");
    }
    //首页
    public function index(){
        $admins=Admin::all();
        return view("admin.admin.index",compact("admins"));
    }

    //删除
    public function del(Request $request,$id)
    {
        if($id=="4"){
            $request->session()->flash("danger","不能删除管理员");
            return redirect()->route("admin.index");
        }
        Admin::destroy($id);
        $request->session()->flash("success","删除成功");
        return redirect()->route("admin.index");
    }
}
