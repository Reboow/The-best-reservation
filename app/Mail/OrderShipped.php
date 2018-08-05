<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/8/4
 * Time: 16:52
 */

namespace App\Mail;



use App\Http\Controllers\Controller;

class OrderShipped extends Controller
{
    public function __construct(Order $order)
    {
        $this->order->$order;



    }

}