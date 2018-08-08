@extends("layouts.admin.default")
@section("content")
    <form class="form-inline" method="get" action="">
        <div class="form-group">
            <label for="exampleInputName2"></label>
            <select name="num" id="" class="form-control">
                <option value="0">全部</option>
                <option value="1" @if(request()->input("num")==1) selected @endif>进行中</option>
                <option value="2" @if(request()->input("num")==2) selected @endif>未进行</option>
                <option value="3" @if(request()->input("num")==3) selected @endif>已结束</option>
            </select>
        </div>

        <button type="submit" class="btn btn-success">搜索活动</button>
    </form>


    <a href="{{route("activity.add")}}" class="btn bg-success">添加</a>
    <table class="table table-hover table-bordered">
        <tr>
            <th>id</th>
            <th>标题</th>
            <th>开始时间</th>
            <th>结束时间</th>
            <th>活动内容</th>
            <th>操作</th>
        </tr>
        @foreach($activitys as $activity)
        <tr>
            <td>{{$activity->id}}</td>
            <td>{{$activity->title}}</td>
            <td>{{date("Y-m-d",$activity->start_time)}}</td>
            <td>{{date("Y-m-d",$activity->end_time)}}</td>
            <td>{!! $activity->content !!}</td>
            <td>
                <a href="{{route("activity.edit",$activity)}}" class="btn btn-success">编辑</a>
                <a href="{{route("activity.del",$activity)}}" class="btn btn-danger">删除</a>
            </td>
        </tr>
        @endforeach

    </table>
    {{$activitys->appends($arr)->links()}}
    @endsection