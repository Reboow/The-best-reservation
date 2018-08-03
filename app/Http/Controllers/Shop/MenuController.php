<?php

namespace App\Http\Controllers\Shop;

use App\Models\Menu;
use App\Models\MenuCategory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class MenuController extends Controller
{
    //添加菜品
    public function add(Request $request)
    {
        $shop=Auth::user()->shop_id;
        //判断是否POST提交
        if ($request->isMethod("post")){
            $this->validate($request,[
                "goods_name"=>"required",
                "goods_price"=>"required|",
                "description"=>"required",
                "month_sales"=>"required|int",
                "rating_count"=>"required|int",
                "tips"=>"required",
                "satisfy_count"=>"required|int",
                "satisfy_rate"=>"required|",
                "status"=>"required|int",
                "rating"=>"int",
            ]);
            $data=$request->post();

            //添加shop_id
            $data["shop_id"]=$shop;
//            //判断是否有图片上传
//            if ($request->file("goods_img")){
//                $data["goods_img"]=$request->file("goods_img")->store("goods","oss");
//            }
            Menu::create($data);
            return redirect()->route("menu.index")->with("success","添加成功");

        }
        $cates=MenuCategory::all();
        return view("shop.menu.add",compact("cates"));
    }

    //显示首页
    public function index(Request $request)
    {
        $cates=MenuCategory::all();
            $min = $request->min_price;
            $max = $request->max_price;
            $keyword = $request->keyword;
            $cate_id=$request->cate_id;
            $arr=$request->query();
            $query=Menu::orderBy("id");
            if ($min!==null){
                $query->where("goods_price",">=",$min);
            }
            if ($max!==null){
            $query->where("goods_price","=<",$min);
             }
            if ($keyword!==null){
                $query->where("goods_name","like","%$keyword%");
            }
            if ($cate_id!==null){
                $query->where("category_id","=",$cate_id);
            }
            $menus=$query->paginate(2);
        return view("shop.menu.index",compact("menus","cates","arr"));

    }

    //编辑
    public function edit(Request $request,$id)
    {
        $menu=Menu::find($id);
        $shop=Auth::user()->shop_id;
        //判断是否POST提交
        if ($request->isMethod("post")){
            $this->validate($request,[
                "goods_name"=>"required",
                "goods_price"=>"required|",
                "description"=>"required",
                "month_sales"=>"required|int",
                "rating_count"=>"required|int",
                "tips"=>"required",
                "satisfy_count"=>"required|int",
                "satisfy_rate"=>"required|",
                "status"=>"required|int",
                "rating"=>"int",
            ]);
            $data=$request->post();
            $data["goods_img"]=$menu->goods_img;

            //添加shop_id
            $data["shop_id"]=$shop;
            //判断是否有图片上传
            if ($request->file("goods_img")){
                $data["goods_img"]=$request->file("goods_img")->store("goods","img");
            }

            $menu->update($data);
            return redirect()->route("menu.index")->with("success","编辑成功");

        }
        $cates=MenuCategory::all();
        return view("shop.menu.edit",compact("menu","cates"));
    }

    //删除
    public function del(Request $request,$id)
    {
        Menu::destroy($id);
        return redirect()->route("menu.index")->with("success","删除成功");
    }

    //图片上传
    public function upload(Request $request)
    {
        $file=$request->file("file");
        if ($file){
            $img=$request->file("file")->store("menu","oss");
            $data=[
                "img"=>"https://1035179525.oss-cn-shenzhen.aliyuncs.com/".$img,
            ];
        }else{
            $data="";
        }
        return $data;
    }
}
