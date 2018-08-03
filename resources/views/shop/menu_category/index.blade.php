@extends("layouts.shop.default")
@section("content")
    <a href="{{route("menucategory.add")}}" class="btn bg-success">添加</a>
    <table class="table table-bordered table-hover">
        <tr>
            <th>id</th>
            <th>菜品分类名字</th>
            <th>分类描述</th>
            <th>是否默认分类</th>
            <th>菜品分类店铺</th>
            <th>菜品分类标号</th>
            <th>操作</th>
        </tr>
        @foreach($cates as $cate)
        <tr>
            <td>{{$cate->id}}</td>
            <td>{{$cate->name}}</td>
            <td>{{$cate->description}}</td>
            <td>{{$cate->is_selected?"是":"否"}}</td>
            <td>{{$cate->getShop->shop_name}}</td>
            <td>{{$cate->type_accumulation}}</td>
            <td>
                <a href="{{route("menucategory.edit",$cate)}}" class="btn btn-info">编辑</a>
                <a href="{{route("menucategory.del",$cate)}}" class="btn btn-danger">删除</a>

            </td>
        </tr>
            @endforeach
    </table>
    {{$cates->links()}}
    @endsection