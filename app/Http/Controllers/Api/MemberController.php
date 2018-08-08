<?php

namespace App\Http\Controllers\Api;

use App\Models\Member;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Validator;
use Mrgoon\AliSms\AliSms;

class MemberController extends BaseController
{
    //注册
    public function reg(Request $request)
    {
        $arr=$request->all();
        //获取验证码
        $code=Redis::get("tel_".$arr["tel"]);
        if ($code!=$arr["sms"]){
            return $data=[
              "status"=>"false",
              "message"=>"验证码不对",
            ];
        }

        $validator = Validator::make($arr, [
            'username' => 'required|unique:members|max:255',
            'password' => 'required|max:255',
            'tel' => [
                "required",
                "regex:/^0?(13|14|15|17|18|19)[0-9]{9}$/"
            ],
            'sms' => 'required|integer|min:1000|max:9999',
        ]);

        if ($validator->fails()) {
            return $data=[
                "status"=>"false",
                "message"=>$validator->errors()->first(),
            ];
        }
        //新建用户
        $arr["password"]=bcrypt($arr["password"]);
        Member::create($arr);
        return $data=[
            "status"=>"true",
            "message"=>"注册成功",
        ];



    }
    //短信验证
    public function sms(Request $request)
    {
        $config = [
            'access_key' => 'LTAI78PNz7tuUICR',
            'access_secret' => 'Nip9fJfAfFMksbrHyKLW0CqlLbHgN8',
            'sign_name' => '康昭阳',
        ];

        //得到CODE
        $code=rand(1000,9999);
        $tel=$request->input("tel");

        //存入redis
        Redis::set("tel_".$tel,$code);
        Redis::expire("tel_".$tel,300);


        $sms=new AliSms();
        $response = $sms->sendSms($tel, 'SMS_141570122', ['code'=> $code], $config);

        if ($response){
            return $data=[
                "status"=>"true",
                "message"=>"获取验证码成功",
            ];
        }
        return       $data=[
        "status"=>"false",
        "message"=>"获取验证码失败",
    ];

    }

    public function login(Request $request){
        $data=$request->post();
        $user=Member::where("username",$data["name"])->get()->first();
//        $pass=$user[0]["password"];
//        if (!isset($user[0])){
//            return $arr=[
//                "status"=>"false",
//                 "message"=>"找不到用户",
//            ];
//        }

        if ($user && Hash::check($data["password"],$user->password)){
            return $arr=[
                "status"=>"true",
             "message"=>"登录成功",
        "user_id"=>$user->id,
        "username"=>$user->username
            ];
        }
        return $arr=[
            "status"=>"false",
            "message"=>"用户账号错误",
        ];


    }

    public function detail(){
        return Member::find(\request()->input("user_id"));
    }

    public function change()
    {
        $id=\request()->input("id");
        $member=Member::find($id);

        if (Hash::check(\request()->input("oldPassword"),$member->password)){
            $member->password=bcrypt(\request()->input("newPassword"));                $member->save();
            return [
                "status"=>"true",
                "message"=>"修改成功",
            ];
        }
        return [
            "status"=>"false",
            "message"=>"旧密码错误",
        ];
    }

}
