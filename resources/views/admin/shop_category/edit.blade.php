@extends("layouts.admin.default")
@section("title","添加")
@section("content")
    <form class="form-horizontal" method="post" action="" enctype="multipart/form-data">
        {{ csrf_field() }}
        <div class="form-group">
            <label for="inputEmail3" class="col-sm-2 control-label">名字</label>
            <div class="col-sm-5">
                <input type="text" class="form-control" id="inputEmail3" placeholder="" name="name" value="{{old("name",$cate->name)}}">
            </div>
        </div>
        <div class="form-group">
            <label for="inputPassword3" class="col-sm-2 control-label">简介</label>
            <div class="col-sm-5">
                <input type="text" class="form-control" id="inputPassword3" placeholder="" name="intro" value="{{old("intro",$cate->intro)}}">
            </div>
        </div>
        <div class="form-group">
            <label for="inputPassword3" class="col-sm-2 control-label">是否上线</label>
            <div class="col-sm-5">
                <input type="radio" value="1" name="status" @if($cate->status=="1")  checked @endif>是
                <input type="radio" value="0" name="status" @if($cate->status=="0") checked @endif >否
            </div>
        </div>
        <img src="/app/{{$cate->logo}}" alt="" width="50">
        <div class="form-group">
            <label for="inputPassword3" class="col-sm-2 control-label">图片</label>
            <div class="col-sm-5">
                <input type="file"  name="img" value="">
            </div>
        </div>
        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
                <button type="submit" class="btn btn-default">添加</button>
            </div>
        </div>
    </form>
    @endsection