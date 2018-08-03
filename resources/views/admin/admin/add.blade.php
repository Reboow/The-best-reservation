@extends("layouts.admin.default")
@section("title","添加")
@section("content")
    <form class="form-horizontal" method="post" action="" enctype="multipart/form-data">
        {{ csrf_field() }}
        <div class="form-group">
            <label for="inputEmail3" class="col-sm-2 control-label">管理员名字</label>
            <div class="col-sm-5">
                <input type="text" class="form-control" id="inputEmail3" placeholder="" name="name" value="{{old("name")}}">
            </div>
        </div>
        <div class="form-group">
            <label for="inputPassword3" class="col-sm-2 control-label">管理员密码</label>
            <div class="col-sm-5">
                <input type="text" class="form-control" id="inputPassword3" placeholder="" name="password" value="{{old("password")}}">
            </div>
        </div>
        <div class="form-group">
            <label for="inputPassword3" class="col-sm-2 control-label">确认密码</label>
            <div class="col-sm-5">
                <input type="text" class="form-control" id="inputPassword3" placeholder="" name="password_confirmation" value="{{old("")}}">
            </div>
        </div>
        <div class="form-group">
            <label for="inputPassword3" class="col-sm-2 control-label">邮箱</label>
            <div class="col-sm-5">
                <input type="text" class="form-control" id="inputPassword3" placeholder="" name="email" value="{{old("email")}}">
            </div>
        </div>
        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
                <button type="submit" class="btn btn-default">添加</button>
            </div>
        </div>
    </form>
    @endsection