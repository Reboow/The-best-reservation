@extends("layouts.shop.default")
@section("title","添加")
@section("content")
    <br/>
    <form class="form-horizontal" method="post" action="" enctype="multipart/form-data">
        {{ csrf_field() }}
        <div class="form-group">
            <label for="inputEmail3" class="col-sm-2 control-label">菜品名字</label>
            <div class="col-sm-5">
                <input type="text" class="form-control" id="inputEmail3" placeholder="" name="goods_name" value="{{old("goods_name",$menu->goods_name)}}">
            </div>
        </div>
        <div class="form-group">
            <label for="inputPassword3" class="col-sm-2 control-label">菜品评分</label>
            <div class="col-sm-5">
                <input type="text" class="form-control" id="inputPassword3" placeholder="" name="rating" value="{{old("rating",$menu->rating)}}">
            </div>
        </div>
        <div class="form-group">
            <label for="inputPassword3" class="col-sm-2 control-label">所属商品分类</label>
            <div class="col-sm-5">
                <select name="category_id" id="" class="form-control">
                    @foreach($cates as $cate)
                    <option value="{{$cate->id}}" @if($cate->id==$menu->category_id)  selected @endif>{{$cate->name}}</option>
                        @endforeach
                </select>
            </div>
        </div>
        <div class="form-group">
            <label for="inputPassword3" class="col-sm-2 control-label">菜品价格</label>
            <div class="col-sm-2">
                <input type="text" class="form-control"  name="goods_price" value="{{old("goods_price",$menu->goods_price)}}">
            </div>
        </div>
        <div class="form-group">
            <label for="inputPassword3" class="col-sm-2 control-label">菜品描述</label>
            <div class="col-sm-2">
                <textarea name="description" id="" cols="30" rows="10">
                    {{old("description",$menu->description)}}
                </textarea>
            </div>
        </div>
        <div class="form-group">
            <label for="inputPassword3" class="col-sm-2 control-label">月销量</label>
            <div class="col-sm-2">
                <input type="text" class="form-control"  name="month_sales" value="{{old("month_sales",$menu->month_sales)}}">
            </div>
        </div>
        <div class="form-group">
            <label for="inputPassword3" class="col-sm-2 control-label">评分数量</label>
            <div class="col-sm-2">
                <input type="text" class="form-control"  name="rating_count" value="{{old("rating_count",$menu->rating_count)}}">
            </div>
        </div>
        <div class="form-group">
            <label for="inputPassword3" class="col-sm-2 control-label">提示信息</label>
            <div class="col-sm-2">
                <input type="text" class="form-control"  name="tips" value="{{old("tips",$menu->tips)}}">
            </div>
        </div>
        <div class="form-group">
            <label for="inputPassword3" class="col-sm-2 control-label">满意度数量</label>
            <div class="col-sm-2">
                <input type="text" class="form-control"  name="satisfy_count" value="{{old("satisfy_count",$menu->satisfy_count)}}">
            </div>
        </div>
        <div class="form-group">
            <label for="inputPassword3" class="col-sm-2 control-label">满意度评分</label>
            <div class="col-sm-2">
                <input type="text" class="form-control"  name="satisfy_rate" value="{{old("satisfy_rate",$menu->satisfy_rate)}}">
            </div>
        </div>
        <div class="form-group">
            <label for="inputPassword3" class="col-sm-2 control-label">菜品图片</label>
            <div class="col-sm-2">
                <img src="/app/{{$menu->goods_img}}" alt="" width="50">
                <input type="file" name="goods_img">
            </div>
        </div>
        <div class="form-group">
            <label for="inputPassword3" class="col-sm-2 control-label">是否上架</label>
            <div class="col-sm-2">
                <input type="radio" value="1" name="status" {{$menu->status?"checked":""}}>是
                <input type="radio" value="0" name="status" {{$menu->status?"":"checked"}}>否
            </div>
        </div>



        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
                <button type="submit" class="btn btn-default">编辑</button>
            </div>
        </div>
    </form>
    @endsection