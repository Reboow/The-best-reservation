@extends("layouts.shop.default")
@section("title","添加")
@section("content")
    <form class="form-horizontal" method="post" action="" enctype="multipart/form-data">
        {{ csrf_field() }}
        <div class="form-group">
            <label for="inputEmail3" class="col-sm-2 control-label">菜品分类名字</label>
            <div class="col-sm-5">
                <input type="text" class="form-control" id="inputEmail3" placeholder="" name="name" value="{{old("name")}}">
            </div>
        </div>
        <div class="form-group">
            <label for="inputPassword3" class="col-sm-2 control-label">菜品编号</label>
            <div class="col-sm-5">
                <input type="text" class="form-control" id="inputPassword3" placeholder="" name="type_accumulation" value="{{old("type_accumulation")}}">
            </div>
        </div>
        <div class="form-group">
            <label for="inputPassword3" class="col-sm-2 control-label">是否默认</label>
            <div class="col-sm-5">
                <input type="radio" value="1" name="is_selected">是
                <input type="radio" value="0" name="is_selected">否
            </div>
        </div>
        <div class="form-group">
            <label for="inputPassword3" class="col-sm-2 control-label">菜品描述</label>
            <div class="col-sm-5">
                <textarea name="description" id="" cols="30" rows="10">

                </textarea>
            </div>
        </div>
        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
                <button type="submit" class="btn btn-default">添加</button>
            </div>
        </div>
    </form>
    @endsection