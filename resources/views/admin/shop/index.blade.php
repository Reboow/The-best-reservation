@extends("layouts.admin.default")
@section("content")
    <a href="{{route("shop.add")}}" class="btn bg-success">添加</a>
    <table class="table table-bordered table-hover">
        <tr>
            <th>id</th>
            <th>用户名</th>
            <th>用户邮箱</th>
            <th>店铺名字</th>
            {{--<th>店铺类别</th>--}}
            {{--<th>店铺评分</th>--}}
            <th>是否品牌</th>
            <th>是否准时</th>
            <th>是否蜂鸟</th>
            <th>是否保</th>
            <th>是否票</th>
            <th>起送费用</th>
            <th>配送费用</th>
            <th>店铺公告</th>
            <th>优惠信息</th>
            <th>店铺状态</th>
            <th>店铺图片</th>
            <th>操作</th>
        </tr>
        @foreach($users as $user)
        <tr>
            <td>{{$user->id}}</td>
            <td>{{$user->name}}</td>
            <td>{{$user->email}}</td>
            <td>{{$user->getShop->shop_name}}</td>
            {{--<td>{{$user->getShop->shop_img}}</td>--}}
            {{--<td>{{$user->getShop->shop_rating}}</td>--}}
            <td>{{$user->getShop->brand?"是":"否"}}</td>
            <td>{{$user->getShop->on_time?"是":"否"}}</td>
            <td>{{$user->getShop->fengniao?"是":"否"}}</td>
            <td>{{$user->getShop->bao?"是":"否"}}</td>
            <td>{{$user->getShop->piao?"是":"否"}}</td>
            <td>{{$user->getShop->start_send}}</td>
            <td>{{$user->getShop->send_cost}}</td>
            <td><textarea cols="20" rows="5">
                    {{$user->getShop->notice}}
                </textarea></td>
            <td><textarea cols="20" rows="5">
                    {{$user->getShop->discount}}
                </textarea></td>
            <td><?php
                if($user->getShop->status==1){
                    echo "正常";
                } elseif($user->getShop->status==0){
                    echo "待审核";
                }elseif ($user->getShop->staus==null){
                    echo "禁用";
                }
                    ?>
            </td>
            <td><img src="{{'/app/'.$user->getShop->img}}" alt="" width="50"></td>
            <td>
                @if ($user->getShop->status==0)
                    <a href="{{route("shop.update",$user->getShop->id)}}" class="btn btn-info">请审核</a>
                @elseif($user->getShop->status==1)
                    <a href="{{route("shop.status",$user->getShop->id)}}" class="btn btn-danger">禁用</a>
                    @elseif($user->getShop->status==-1)
                    <a href="{{route("shop.status",$user->getShop->id)}}" class="btn btn-success">启用</a>
                    @endif
                    <a href="{{route("shop.edit",$user->id)}}" class="btn btn-info">编辑</a>
                    <a href="{{route("shop.del",$user->id)}}"class="btn btn-danger">删除</a>
                    <a href="{{route("shop.reset",$user->id)}}" class="btn btn-info">重置密码</a>
            </td>
        </tr>
        @endforeach
    </table>
    {{$users->links()}}
    @endsection