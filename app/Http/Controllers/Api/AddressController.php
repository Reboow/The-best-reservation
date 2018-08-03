<?php

namespace App\Http\Controllers\Api;

use App\Models\Address;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class AddressController extends Controller
{

    public function add(Request $request){
        //验证
        $validator = Validator::make($request->all(), [
            'name'=> 'required',
            'tel' => [
                "required",
                "regex:/^0?(13|14|15|17|18|19)[0-9]{9}$/"
            ],
            "provence"=>"required",
            "city"=>"required",
            "area"=>"required",
            "detail_address"=>"required"
        ]);

        if ($validator->fails()) {
            return [
                "status"=> "false",
                "message"=> $validator->errors()->first()
            ];
        }

        Address::create($request->all());
        return [
            "status"=> "ture",
            "message"=> "添加成功"
        ];


    }

    public function index(Request $request)
    {
        $id=$request->user_id;
        $address=Address::where("user_id",$id)->get();
        return $address;

    }

    public function edit(Request $request){
        $id=$request->id;
        return Address::findOrFail($id);

    }

    public function update(Request $request){
        //验证


        $validator = Validator::make($request->all(), [
            'name'=> 'required',
            'tel' => [
                "required",
                "regex:/^0?(13|14|15|17|18|19)[0-9]{9}$/"
            ],
            "provence"=>"required",
            "city"=>"required",
            "area"=>"required",
            "detail_address"=>"required"
        ]);

        if ($validator->fails()) {
            return [
                "status"=> "false",
                "message"=> $validator->errors()->first()
            ];
        }

       $address =Address::findOrFail($request->id);

        $address->update($request->all());

        return [
            "status"=> "true",
            "message"=> "修改成功"
        ];

    }
}
