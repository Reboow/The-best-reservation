
@extends("layouts.admin.default")
@include('vendor.ueditor.assets')
@section("content")
    <br/>
    <form class="form-horizontal" method="post" enctype="multipart/form-data">
        {{csrf_field()}}
        <div class="form-group">
            <label for="inputEmail3" class="col-sm-2 control-label">活动标题</label>
            <div class="col-sm-5">
                <input type="text" class="form-control" id="inputEmail3"  name="title" value="{{old("title")}}">
            </div>
        </div>

        <div class="form-group">
            <label for="inputEmail3" class="col-sm-2 control-label">开始时间</label>
            <div class="col-sm-5">
                <input type="date" class="form-control" id="inputEmail3"  name="start_time" value="{{old("start_time")}}">
            </div>
        </div>
        <div class="form-group">
            <label for="inputEmail3" class="col-sm-2 control-label">截止时间</label>
            <div class="col-sm-5">
                <input type="date" class="form-control" id="inputEmail3"  name="end_time" value="{{old("end_time")}}">
            </div>
        </div>
        <div class="form-group">
            <label for="inputEmail3" class="col-sm-2 control-label">活动内容</label>
            <div class="col-sm-5">
                <!-- 实例化编辑器 -->
                <script type="text/javascript">
                    var ue = UE.getEditor('container');
                    ue.ready(function() {
                        ue.execCommand('serverparam', '_token', '{{ csrf_token() }}'); // 设置 CSRF token.
                    });
                </script>

                <!-- 编辑器容器 -->
                <script id="container" name="content" type="text/plain">
                    {{old("content")}}
                </script>
            </div>
        </div>
        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
                <button type="submit" class="btn btn-default">添加</button>
            </div>
        </div>
    </form>
@endsection



