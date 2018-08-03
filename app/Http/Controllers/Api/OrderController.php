<?php

namespace App\Http\Controllers\Api;

use App\Models\Address;
use App\Models\Cart;
use App\Models\Member;
use App\Models\Menu;
use App\Models\Order;
use App\Models\OrderGoods;
use App\Models\Shop;
use Doctrine\DBAL\Query\QueryException;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use function Sodium\crypto_box_publickey_from_secretkey;

class OrderController extends BaseController
{
    //订单添加
    public function add()
    {
        //接受参数
        //会员ID
        $uid = \request()->input("user_id");
        //地址ID
        $aid = \request()->input("address_id");
        //找到购物车
        $carts = Cart::where("user_id", $uid)->get();

        $data["user_id"] = $uid;
        $data["shop_id"] = Menu::find($carts[0]->goods_id)->shop_id;
        //找到地址
        $adrress = Address::find($aid);
        $data["name"] = $adrress->name;
        $data["provence"] = $adrress->provence;
        $data["city"] = $adrress->city;
        $data["area"] = $adrress->area;
        $data["detail_address"] = $adrress->detail_address;
        $data["tel"] = $adrress->tel;
        $data["sn"] = date("ymdhis") . rand(1000, 9999);
        $total = "";
        //计算出总价
        foreach ($carts as $cart) {
            $good = Menu::find($cart->goods_id);
            $total += $cart->amount * $good->goods_price;
        }
        $data["total"] = $total;

        //保存订单
        //开启事务
        DB::beginTransaction();
        try{
            $order = Order::create($data);

            //订单商品表
            foreach ($carts as $cart) {
                $goods = Menu::find($cart->goods_id);
                $arr = [
                    "order_id" => $order->id,
                    "goods_id" => $cart->goods_id,
                    "goods_name" => $goods->goods_name,
                    "goods_price" => $goods->goods_price,
                    "goods_img" => $goods->goods_img,
                    "amount" => $cart->amount,
                ];
                OrderGoods::create($arr);
            }
            //提交
            DB::commit();

        }catch (\Illuminate\Database\QueryException $exception){
            DB::rollBack();
            return [
                "status" => "false",
                "message" => "添加失败",
            ];

        }





        return [
            "status" => "true",
            "message" => "添加成功",
            "order_id" => $order->id
        ];

    }

    //订单详情
    public function index()
    {
        //订单ID
        $id = \request()->input("user_id");
        //找到订单
        $order = Order::find($id);
        $data["user_id"] = (string)$order->user_id;
        $data["order_code"] = $order->sn;
        $data["order_birth_time"] = (string)$order->created_at;
        $data["order_status"] = $order->OrderStatus;
        $data["shop_id"] = (string)$order->shop_id;
        //找到店铺
        $shop = Shop::find($data["shop_id"]);
        $data["shop_name"] = $shop->shop_name;
        $data["shop_img"] = $shop->shop_img;

        //找到订单商品表
        $goods = OrderGoods::where("order_id", $order->id)->get();
        $data["goods_list"] = $goods;
        $data["order_price"] = $order->total;
        $data["order_address"] = $order->provence . $order->city . $order->area . $order->detail_address;

        return $data;
    }

    //订单列表
    public function list()
    {
        $id = \request()->input("user_id");
        $orders = Order::where("user_id", $id)->get();

        foreach ($orders as $order) {
            $order->id = "$order->id";
            $order->order_code = $order->sn;
            $order->rder_birth_time = (string)$order->created_at;
            $order->order_status = $order->OrderStatus;

            $shop = Shop::find($order->shop_id);
            $order->shop_name = $shop->shop_name;
            $order->shop_img = $shop->shop_img;

            //找到商品
            $goods = OrderGoods::where("order_id", $order->id)->get();
            foreach ($goods as $k => $good) {
                $good->amount = $order->amout;
            }
            $order->goods_list = $goods;
            $order->order_price = $order->total;
            $order->order_address = $order->detail_address;
        }

        return $orders;
    }

    //支付
    public function pay()
    {
        $order = Order::find(\request()->input("id"));
        $user = Member::find($order->user_id);
        $money = $order->total;
        if ($user->money < $money) {
            return [
                "status" => "false",
                "message" => "余额不足"
            ];
        }
        $user->money=$user->money-$money;
        $order->status=1;
        $user->save();
        $order->save();
        return [
            "status" => "true",
            "message" => "支付成功"
        ];
    }
}
