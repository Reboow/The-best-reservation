
@extends("layouts.admin.default")
@section("content")
    <br/>
    <form class="form-horizontal" method="post" enctype="multipart/form-data">
        {{csrf_field()}}
        <div class="form-group">
            <label for="inputEmail3" class="col-sm-2 control-label">用户名</label>
            <div class="col-sm-5">
                <input type="text" class="form-control" id="inputEmail3"  name="name"
                value="{{old("name",$user->name)}}">
            </div>
        </div>
        <div class="form-group">
            <label for="inputPassword3" class="col-sm-2 control-label">邮箱</label>
            <div class="col-sm-5" >
                <input type="email" class="form-control" id="inputPassword3" placeholder="邮箱" name="email" value="{{old("email",$user->email)}}">
            </div>
        </div>
        <div class="form-group">
            <label for="inputPassword3" class="col-sm-2 control-label">店铺名字</label>
            <div class="col-sm-5">
                <input type="text" class="form-control" id="inputPassword3" placeholder="" name="shop_name" value="{{old("shop_name",$shop->shop_name)}}">
            </div>
        </div>
        <div class="form-group">
            <label for="inputPassword3" class="col-sm-2 control-label">店铺分类</label>
            <div class="col-sm-3">
                <select name="shop_category_id" class="form-control" >
                    @foreach($cates as $cate)
                    <option value="{{$cate->id}}"
                    @if($cate->id===$shop->shop_category_id)
                    selected
                            @endif
                    >{{$cate->name}}</option>
                        @endforeach
                </select>
            </div>
        </div>
        <div class="form-group">
            <label for="inputPassword3" class="col-sm-2 control-label">店铺评分</label>
            <div class="col-sm-5">
                <input type="text" class="form-control" id="inputPassword3" placeholder="" name="rating" value="{{old("rating",$shop->rating)}}">
            </div>
        </div>
        <div class="form-group">
            <label for="inputPassword3" class="col-sm-2 control-label">是否品牌</label>
            <div class="col-sm-5">
                <input type="radio" value="1" name="brand" {{$shop->brand?"checked":""}}>是
                <input type="radio" value="0" name="brand" {{$shop->brand?"":"checked"}}>否
            </div>
        </div>
        <div class="form-group">
            <label for="inputPassword3" class="col-sm-2 control-label">是否准时送达</label>
            <div class="col-sm-5">
                <input type="radio" value="1" name="on_time" {{$shop->on_time?"checked":""}}>是
                <input type="radio" value="0" name="on_time"{{$shop->on_time?"":"checked"}}>否
            </div>
        </div>
        <div class="form-group">
            <label for="inputPassword3" class="col-sm-2 control-label">是否蜂鸟</label>
            <div class="col-sm-5">
                <input type="radio" value="1" name="fengniao" {{$shop->fengniao?"checked":""}}>是
                <input type="radio" value="0" name="fengniao" {{$shop->fengniao?"":"checked"}}>否
            </div>
        </div>
        <div class="form-group">
        <label for="inputPassword3" class="col-sm-2 control-label">是否保</label>
        <div class="col-sm-5">
            <input type="radio" value="1" name="bao" {{$shop->bao?"checked":""}}>是
            <input type="radio" value="0" name="bao" {{$shop->bao?"":"checked"}}>否
        </div>
        </div>
        <div class="form-group">
            <label for="inputPassword3" class="col-sm-2 control-label">是否票</label>
            <div class="col-sm-5">
                <input type="radio" value="1" name="piao" {{$shop->piao?"checked":""}}>是
                <input type="radio" value="0" name="piao" {{$shop->piao?"":"checked"}}>否
            </div>
        </div>
        <div class="form-group">
            <label for="inputPassword3" class="col-sm-2 control-label">是否准</label>
            <div class="col-sm-5">
                <input type="radio" value="1" name="zhun" {{$shop->zhun?"checked":""}}>是
                <input type="radio" value="0" name="zhun" {{$shop->zhun?"":"checked"}}>否
            </div>
        </div>
        <div class="form-group">
            <label for="inputEmail3" class="col-sm-2 control-label">起送额度</label>
            <div class="col-sm-5">
                <input type="text" class="form-control" id="inputEmail3"  name="start_send" value="{{$shop->start_send}}">
            </div>
        </div>
        <div class="form-group">
            <label for="inputEmail3" class="col-sm-2 control-label">配送费</label>
            <div class="col-sm-5">
                <input type="text" class="form-control" id="inputEmail3"  name="send_cost" value="{{$shop->send_cost}}">
            </div>
        </div>
        <div class="form-group">
            <label for="inputEmail3" class="col-sm-2 control-label">店公告</label>
            <div class="col-sm-5">
                <textarea name="notice" id="" cols="30" rows="10">
                {{$shop->notice}}
                </textarea>
            </div>
        </div>
        <div class="form-group">
            <label for="inputEmail3" class="col-sm-2 control-label">优惠信息</label>
            <div class="col-sm-5">
                <textarea name="discount" id="" cols="30" rows="10">
              {{$shop->discount}}
                </textarea>
            </div>
        </div>
        <img src="/app/{{$shop->img}}" alt="">
        <div class="form-group">
            <label for="inputEmail3" class="col-sm-2 control-label">店铺图片</label>
            <div class="col-sm-5">
                <input type="file" name="img">
            </div>
        </div>


        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
                <button type="submit" class="btn btn-default">编辑</button>
            </div>
        </div>
    </form>
@endsection



