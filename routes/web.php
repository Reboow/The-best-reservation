<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});
//商家分类
Route::domain('admin.eleb.com')->namespace('Admin')->group(function () {
    Route::get('/shopcategory/index',"ShopCategoryController@index")->name("shopcategory.index");
    Route::any('/shopcategory/add',"ShopCategoryController@add")->name("shopcategory.add");
    Route::any('/shopcategory/edit/{id}',"ShopCategoryController@edit")->name("shopcategory.edit");
    Route::get('/shopcategory/del/{id}',"ShopCategoryController@del")->name("shopcategory.del");

    //管理员的账号管理
    Route::get('/admin/index',"AdminController@index")->name("admin.index");
    Route::any('/admin/add',"AdminController@add")->name("admin.add");
    Route::any('/admin/login',"AdminController@login")->name("admin.login");
    Route::any('/admin/update/{id}',"AdminController@update")->name("admin.update");
    Route::any('/admin/loginout',"AdminController@loginout")->name("admin.loginout");
    Route::any('/admin/edit/{id}',"AdminController@edit")->name("admin.edit");
    Route::get('/admin/del/{id}',"AdminController@del")->name("admin.del");


});

//店铺
Route::domain('admin.eleb.com')->namespace('Admin')->group(function () {
    Route::get('/shop/index',"ShopController@index")->name("shop.index");
    Route::any('/shop/add',"ShopController@add")->name("shop.add");
    Route::any('/shop/edit/{id}',"ShopController@edit")->name("shop.edit");
    Route::any('/shop/reset/{id}',"ShopController@reset")->name("shop.reset");
    Route::get('/shop/del/{id}',"ShopController@del")->name("shop.del");
    Route::get('/shop/update/{id}',"ShopController@update")->name("shop.update");
    Route::get('/shop/status/{id}',"ShopController@status")->name("shop.status");
});
//用户
Route::domain('shop.eleb.com')->namespace('shop')->group(function () {
    Route::get('/user/index',"UserController@index")->name("user.index");
    Route::any('/user/login',"UserController@login")->name("user.login");
    Route::any('/user/loginout',"UserController@loginout")->name("user.loginout");
    Route::any('/user/reg',"UserController@reg")->name("user.reg");
    Route::any('/user/add',"UserController@add")->name("user.add");
    Route::any('/user/edit/{id}',"UserController@edit")->name("user.edit");
    Route::get('/user/del/{id}',"UserController@del")->name("user.del");
    Route::any('/user/pass/{id}',"UserController@pass")->name("user.pass");
});