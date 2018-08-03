<?php

namespace App\Http\Controllers\Api;

use App\Models\Menu;
use App\Models\MenuCategory;
use App\Models\Shop;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ShopController extends BaseController
{
    //列表
    public function list(Request $request)
    {
        $keyword=$request->input("keyword");

        $shops=Shop::where("shop_name","like","%$keyword%")->where("status","1")->get();

        foreach ($shops as $shop){
            $shop->shop_img='/app/'.$shop->img;
        }
        return $shops;
    }
    //首页
    public function index(Request $request)
    {
        $id=$request->input("id");

        $shop=Shop::findOrFail($id);
        $shop->shop_img="/app/".$shop->img;
        $shop->evaluate=[
            [
                "user_id"=>12344,
                "username"=>"w******k",
                "user_img"=>"http://www.homework.com/images/slider-pic4.jpeg",
                "time"=>"2017-2-22",
                "evaluate_code"=>1,
                "send_time"=>30,
                "evaluate_details"=>"不怎么好吃"
            ],

            [
                "user_id"=>12344,
                "username"=>"w******k",
                "user_img"=>"http://www.homework.com/images/slider-pic4.jpeg",
                "time"=>"2017-2-22",
                "evaluate_code"=>1,
                "send_time"=>30,
                "evaluate_details"=>"不怎么好吃"
            ]
        ];
        $cates=MenuCategory::where("shop_id",$id)->get();
//        dd($cates);

        $menus=Menu::where("shop_id",$id)->get();



        foreach ($cates as $cate){
            $arr=[];
            foreach ($menus as $menu){
                if ($menu->category_id==$cate->id){
                    array_push($arr,$menu);
                }
                $cate->goods_list=$arr;

            }
        }

//        foreach ($cates as $cate){
//            $cate->goods_list=Menu::where("category_id",$cate->id)->get();
//        }
        $shop->commodity=$cates;
        return $shop;
    }
}
