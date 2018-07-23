<?php

namespace App\Http\Controllers\Admin;

use App\Models\ShopCategory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class ShopCategoryController extends BaseController
{
    //首页
    public function index(){

        $cates=ShopCategory::all();

    return view("admin.shop_category.index",compact("cates"));
    }
    //添加
    public function add(Request $request)
    {
        //判断是否POST提交
        if ($request->isMethod("post")){
            $this->validate($request,[
               "name"=>"required",
               "intro"=>"required",
               "status"=>"required",
            ]);
            $data=$request->all();
            //判断是否有图片上传
            if ($request->file("img")){

                $data["logo"]=$request->file("img")->store("cate","img");
            }
            ShopCategory::create($data);
            $request->session()->flash("success","提交成功");
            //显示视图
            return redirect()->route("shopcategory.index");
        }

        return view("admin.shop_category.add");
    }

    //编辑
    public function edit(Request $request,$id){
        $cate=ShopCategory::find($id);

        if ($request->isMethod("post")){
            $data=$request->post();
            $data["logo"]=$cate->logo;
            if ($request->file("img")){
                File::delete("app/".$data["logo"]);
                $data["logo"]=$request->file("img")->store("cate","img");
            }
            $cate->update($data);
            $request->session()->flash("success","修改成功");
            //显示视图
            return redirect()->route("shopcategory.index");
        }

        return view("admin.shop_category.edit",compact("cate"));
    }
    //删除
    public function del(Request $request,$id)
    {
        if (ShopCategory::destroy($id)) {
            $request->session()->flash("success","删除成功");
            return redirect()->route("shopcategory.index");
        }
    }
}
