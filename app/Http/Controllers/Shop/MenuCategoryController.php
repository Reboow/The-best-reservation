<?php

namespace App\Http\Controllers\Shop;

use App\Models\MenuCategory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class MenuCategoryController extends BaseController
{
    //添加
    public function add(Request $request){
        //判断是否POST提交
        $shop_id=Auth::user()->shop_id;

        if ($request->isMethod("post")){
            $this->validate($request,[
               "name"=>"required",
               "type_accumulation"=>"required",
               "description"=>"required",
            ]);
            //判断是否有默认分类
            if ($request->post("is_selected")){
                //找到以前的默认分类
                $menu=MenuCategory::where("is_selected","=","1")->get();
                //如果$menu有值
                if (isset($menu[0])){
                    $menu[0]->is_selected=0;
                    $menu[0]->save();
                }
            }
            $data=$request->post();
            $data["shop_id"]=$shop_id;
            MenuCategory::create($data);
            return redirect()->route("menucategory.index");

        }
        return view("shop.menu_category.add");
    }
    //显示首页
    public function index(){

        $cates=MenuCategory::paginate(3);
        return  view("shop.menu_category.index",compact("cates"));
    }

    //显示编辑
    public function edit(Request $request,$id)
    {
        $cate=MenuCategory::find($id);
        //判断是否POST提交
        if ($request->isMethod("post")){
            $this->validate($request,[
                "name"=>"required",
                "type_accumulation"=>"required",
                "description"=>"required",
            ]);
            //判断是否有默认分类
            if ($request->post("is_selected")){
                //找到以前的默认分类
                $menu=MenuCategory::where("is_selected","=","1")->get();
                //如果$menu有值
                if (isset($menu[0])){
                    $menu[0]->is_selected=0;
                    $menu[0]->save();
                }
            }
            $cate->update($request->post());
            return redirect()->route("menucategory.index")->with("success","编辑成功");


        }




        return view("shop.menu_category.edit",compact("cate"));
    }
    //删除
    public function del(Request $request,$id)
    {
        MenuCategory::destroy($id);
        return redirect()->route("menucategory.index")->with("success","删除成功");
    }
}
