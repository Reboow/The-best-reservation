<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

//Route::middleware('auth:api')->get('/user', function (Request $request) {
//    return $request->user();
//});

Route::namespace('Api')->group(function () {

    //店铺
    Route::get('/shop/list', "ShopController@list");
    Route::get('/shop/index', "ShopController@index");

    //会员注册
    Route::post('/member/reg', "MemberController@reg");
    Route::post('/member/login', "MemberController@login");
    Route::any('/member/sms', "MemberController@sms");


    //收货地址
    Route::any('/address/add', "AddressController@add");
    Route::any('/address/index', "AddressController@index");
    Route::any('/address/edit', "AddressController@edit");
    Route::any('/address/update', "AddressController@update");


    //购物车
    Route::any('/cart/add', "CartController@add");
    Route::any('/cart/index', "CartController@index");


    //订单
    Route::post("order/add","OrderController@add");
    Route::get("order/detail","OrderController@detail");
    Route::post("order/pay","OrderController@pay");
    Route::get("order/index","OrderController@index");
      Route::get("order/list","OrderController@list");

});
