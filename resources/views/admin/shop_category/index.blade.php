@extends("layouts.admin.default")
@section("content")
    <a href="{{route("shopcategory.add")}}" class="btn bg-success">添加</a>
    <table class="table table-bordered table-hover">
        <tr>
            <th>id</th>
            <th>商铺分类名字</th>
            <th>商铺分类简介</th>
            <th>商铺分类状态</th>
            <th>商铺分类图片</th>
            <th>操作</th>
        </tr>
        @foreach($cates as $cate)
        <tr>
            <td>{{$cate->id}}</td>
            <td>{{$cate->name}}</td>
            <td>{{$cate->intro}}</td>
            <td>{{$cate->status}}</td>
            <td><img src="/app/{{$cate->logo}}" alt="" width="50"></td>
            <td>
                <a href="{{route("shopcategory.edit",$cate)}}" class="btn btn-info">编辑</a>
                <a href="{{route("shopcategory.del",$cate)}}" class="btn btn-danger">删除</a>

            </td>
        </tr>
            @endforeach
    </table>

    @endsection