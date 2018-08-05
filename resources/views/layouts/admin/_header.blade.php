<nav class="navbar navbar-inverse">
    <div class="container-fluid">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="{{route("admin.index")}}">松松是仙女点餐平台</a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">

                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">商家分类管理<span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="{{route("shopcategory.index")}}">商家分类首页</a></li>
                        <li><a href="{{route("shopcategory.add")}}">商家添加</a></li>

                    </ul>
                </li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">商铺管理 <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="{{route("shop.index")}}">商铺首页</a></li>
                        <li><a href="{{route("shop.add")}}">商铺添加</a></li>
                    </ul>
                </li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">管理员管理 <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="{{route("admin.index")}}">管理员列表</a></li>
                        <li><a href="{{route("admin.add")}}">管理员添加</a></li>

                    </ul>
                </li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">活动管理 <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="{{route("activity.index")}}">管理员列表</a></li>
                        <li><a href="{{route("activity.add")}}">管理员添加</a></li>

                    </ul>
                </li>
            </ul>

            <ul class="nav navbar-nav navbar-right">

                @auth("admin")
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">欢迎您:{{\Illuminate\Support\Facades\Auth::guard("admin")->user()->name}}</a>
                        <ul class="dropdown-menu">
                            <li><a href="{{route("admin.update",\Illuminate\Support\Facades\Auth::guard("admin")->user()->id)}}">修改密码</a></li>
                            <li><a href="#">Another action</a></li>
                            <li><a href="#">Something else here</a></li>
                            <li role="separator" class="divider"></li>
                            <li><a href="{{route("admin.loginout")}}">注销登录</a></li>
                        </ul>
                    </li>
                @endauth

                @guest("admin")
                    <li><a href="{{route("admin.login")}}">登录</a></li>
                @endguest


            </ul>
        </div><!-- /.navbar-collapse -->
    </div><!-- /.container-fluid -->
</nav>