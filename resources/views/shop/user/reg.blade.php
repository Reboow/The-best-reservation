
@extends("layouts.shop.default")
@section("content")
    <br/>
    <form class="form-horizontal" method="post" enctype="multipart/form-data">
        {{csrf_field()}}
        <div class="form-group">
            <label for="inputEmail3" class="col-sm-2 control-label">用户名</label>
            <div class="col-sm-5">
                <input type="text" class="form-control" id="inputEmail3"  name="name"
                value="{{old("name")}}">
            </div>
        </div>
        <div class="form-group">
            <label for="inputPassword3" class="col-sm-2 control-label">密码</label>
            <div class="col-sm-5">
                <input type="password" class="form-control" id="inputPassword3" placeholder="Password" name="password" >
            </div>
        </div>
        <div class="form-group">
            <label for="inputPassword3" class="col-sm-2 control-label">邮箱</label>
            <div class="col-sm-5">
                <input type="email" class="form-control" id="inputPassword3" placeholder="邮箱" name="email" value="{{old("email")}}">
            </div>
        </div>
        <div class="form-group">
            <label for="inputPassword3" class="col-sm-2 control-label">店铺名字</label>
            <div class="col-sm-5">
                <input type="text" class="form-control" id="inputPassword3" placeholder="" name="shop_name" value="{{old("shop_name")}}">
            </div>
        </div>
        <div class="form-group">
            <label for="inputPassword3" class="col-sm-2 control-label">店铺分类</label>
            <div class="col-sm-3">
                <select name="shop_category_id" class="form-control" >
                    @foreach($cates as $cate)
                    <option value="{{$cate->id}}">{{$cate->name}}</option>
                        @endforeach
                </select>
            </div>
        </div>
        <div class="form-group">
            <label for="inputPassword3" class="col-sm-2 control-label">店铺评分</label>
            <div class="col-sm-5">
                <input type="text" class="form-control" id="inputPassword3" placeholder="" name="rating" value="{{old("rating")}}">
            </div>
        </div>
        <div class="form-group">
            <label for="inputPassword3" class="col-sm-2 control-label">是否品牌</label>
            <div class="col-sm-5">
                <input type="radio" value="1" name="brand">是
                <input type="radio" value="0" name="brand">否
            </div>
        </div>
        <div class="form-group">
            <label for="inputPassword3" class="col-sm-2 control-label">是否准时送达</label>
            <div class="col-sm-5">
                <input type="radio" value="1" name="on_time">是
                <input type="radio" value="0" name="on_time">否
            </div>
        </div>
        <div class="form-group">
            <label for="inputPassword3" class="col-sm-2 control-label">是否蜂鸟</label>
            <div class="col-sm-5">
                <input type="radio" value="1" name="fengniao">是
                <input type="radio" value="0" name="fengniao">否
            </div>
        </div>
        <div class="form-group">
        <label for="inputPassword3" class="col-sm-2 control-label">是否保</label>
        <div class="col-sm-5">
            <input type="radio" value="1" name="bao">是
            <input type="radio" value="0" name="bao">否
        </div>
        </div>
        <div class="form-group">
            <label for="inputPassword3" class="col-sm-2 control-label">是否票</label>
            <div class="col-sm-5">
                <input type="radio" value="1" name="piao">是
                <input type="radio" value="0" name="piao">否
            </div>
        </div>
        <div class="form-group">
            <label for="inputPassword3" class="col-sm-2 control-label">是否准</label>
            <div class="col-sm-5">
                <input type="radio" value="1" name="zhun">是
                <input type="radio" value="0" name="zhun">否
            </div>
        </div>
        <div class="form-group">
            <label for="inputEmail3" class="col-sm-2 control-label">起送额度</label>
            <div class="col-sm-5">
                <input type="text" class="form-control" id="inputEmail3"  name="start_send">
            </div>
        </div>
        <div class="form-group">
            <label for="inputEmail3" class="col-sm-2 control-label">配送费</label>
            <div class="col-sm-5">
                <input type="text" class="form-control" id="inputEmail3"  name="send_cost">
            </div>
        </div>
        <div class="form-group">
            <label for="inputEmail3" class="col-sm-2 control-label">店公告</label>
            <div class="col-sm-5">
                <textarea name="notice" id="" cols="30" rows="10">

                </textarea>
            </div>
        </div>
        <div class="form-group">
            <label for="inputEmail3" class="col-sm-2 control-label">优惠信息</label>
            <div class="col-sm-5">
                <textarea name="discount" id="" cols="30" rows="10">

                </textarea>
            </div>
        </div>
        <div class="form-group">
            <label for="inputEmail3" class="col-sm-2 control-label">店铺图片</label>
            <div class="col-sm-5">
                <input type="file" name="img">
            </div>
        </div>


        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
                <button type="submit" class="btn btn-default">注册</button>
            </div>
        </div>
    </form>
@endsection



