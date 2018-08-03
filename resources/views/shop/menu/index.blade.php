@extends("layouts.shop.default")
@section("content")
    <br/>
    <form class="form-inline" method="get" action="">
        {{--<div class="form-group">--}}
            {{--<label for="exampleInputName2">最小价格</label>--}}
            {{--<input type="text" class="form-control" id="exampleInputName2" name="min_price" placeholder="最小价格" value="{{request()->input("min_price")}}">--}}
        {{--</div>--}}
        {{--<div class="form-group">--}}
            {{--<label for="exampleInputEmail2">最大价格</label>--}}
            {{--<input type="text" class="form-control" id="exampleInputEmail2" placeholder="最大价格" name="max_price" value="{{request()->input("max_price")}}">--}}
        {{--</div>--}}
        {{--<div class="form-group">--}}
            {{--<input type="text" class="form-control" id="exampleInputEmail2" placeholder="搜索什么？？？" name="keyword" value="{{request()->input("keyword")}}">--}}
        {{--</div>--}}
        {{--<div class="form-group">--}}
            {{--<label for="exampleInputName2">分类</label>--}}
            {{--<select name="cate_id">--}}
                {{--<option value="">全部</option>--}}
                {{--@foreach($cates as $cate)--}}
                {{--<option value="{{$cate->id}}" @if(isset($arr["cate_id"])??""==$cate->id) selected @endif>{{$cate->name}}</option>--}}
                    {{--@endforeach--}}
            {{--</select>--}}
        {{--</div>--}}
        {{--<button type="submit" class="btn btn-default">搜索</button>--}}
    </form>

    <a href="{{route("menu.add")}}" class="btn bg-success">添加</a>
    <table class="table table-bordered table-hover">
        <tr>
            <th>id</th>
            <th>菜品名字</th>
            <th>评分</th>
            <th>所属店铺</th>
            <th>菜品店铺</th>
            <th>菜品价格</th>
            <th>菜品描述</th>
            <th>月销量</th>
            <th>评分数量</th>
            <th>提示信息</th>
            <th>满意度数量</th>
            <th>满意度评分</th>
            <th>图片</th>
            <th>是否上架</th>
            <th>操作</th>
        </tr>
        @foreach($menus as $menu)
        <tr>
            <td>{{$menu->id}}</td>
            <td>{{$menu->goods_name}}</td>
            <td>{{$menu->rating}}</td>
            <td>{{$menu->getShop->shop_name}}</td>
            <td>{{$menu->getCate->name}}</td>
            <td>{{$menu->goods_price}}</td>
            <td>{{$menu->description}}</td>
            <td>{{$menu->month_sales}}</td>
            <td>{{$menu->rating_count}}</td>
            <td>{{$menu->tips}}</td>
            <td>{{$menu->satisfy_count}}</td>
            <td>{{$menu->satisfy_rate}}</td>
            <td>
                <img src="/app/{{$menu->goods_img}}" alt="" width="50">
            </td>
            <td>{{$menu->status?"是":"否"}}</td>
            <td>
                <a href="{{route("menu.edit",$menu)}}" class="btn btn-info">编辑</a>
                <a href="{{route("menu.del",$menu)}}" class="btn btn-danger">删除</a>

            </td>
        </tr>
            @endforeach
    </table>
    {{$menus->appends($arr)->links()}}
    @endsection