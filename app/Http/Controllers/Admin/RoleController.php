<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/8/3
 * Time: 15:09
 */

namespace App\Http\Controllers\Admin;


use http\Env\Request;

class RoleController
{
    public function index()
    {
        
        
    }

    public function add(Request $request)
    {
        if ($request->isMethod('POST')){

            //接收数据
            $data['name'] = $request->POST('name');
            $data['guard_name']="admin";
        }
        
    }

    public function del()
    {
        
    }
}