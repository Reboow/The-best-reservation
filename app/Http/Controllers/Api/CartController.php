<?php

namespace App\Http\Controllers\Api;

use App\Models\Cart;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CartController extends Controller
{
    //添加购物车
    public function add(Request $request)
    {
        $goods = $request->post("goodsList");
        $nums = $request->post("goodsCount");
        //删除用户以前的购物车
        Cart::where("user_id",$request->post("user_id"))->delete();
        //循环插入数据
        foreach ($goods as $k => $good) {
            $data = "";
            $data = [
                "user_id" => $request->post("user_id"),
            ];
            $data["goods_id"] = $goods[$k];
            $data["amount"] = $nums[$k];
            Cart::create($data);
        }
        return ["status" => "true",
            "message" => "添加成功"];

    }

    public function index(Request $request)
    {
        $id = $request->user_id;

        $carts = Cart::where("user_id",$id)->get();
        //获取当前的用户的购物车
        $arr=[];
        $totalPrice="";
        foreach ($carts as $k=>$cart){

        $arr[$k]=[
          "goods_id"=>"$cart->getGoods->id",
            "goods_name"=>$cart->getGoods->goods_name,
            "goods_img"=>$cart->getGoods->goods_img,
             "amount"=>$cart->amount,
            "goods_price"=> $cart->getGoods->goods_price
        ];
        $totalPrice+=$arr[$k]["amount"]*$arr[$k]["goods_price"];
        }

        $data=[];
        $data["goods_list"]=$arr;
        $data["totalCost"]=$totalPrice;

        return $data;
    }
}
