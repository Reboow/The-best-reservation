# DAY01

## 要求

##### 商家注册时，同步填写商家信息，商家账号和密码

##### 商家注册后，需要平台审核通过，账号才能使用

##### 平台可以直接添加商家信息和账户，默认已审核通过

### 实现步骤

###### 1.平台端

创建数据库，数据表，

2.创建视图

3.在商家管理里添加一个商家审核同时可以添加商家店铺默认审核通过

4.在创建一个商家平台

创建后台模板

1 .在商家平台创建商家注册视图

2在商家注册时同时添加商家用户信息

3.商家注册后默认商家状态为待审核,必须通过平台端的审核后才能开通商铺

### 遇见的问题

1.在编辑删除店铺信息时出现了找不到路径 

解决方案：跟着路径找错误

2.添加图片时已跳转但未添加成功

解决方案： 已解决



# DAY02

### 开发任务

- 完善day1的功能，使用事务保证商家信息和账号同时注册成功
- 平台：平台管理员账号管理
- 平台：管理员登录和注销功能，修改个人密码(参考微信修改密码功能)
- 平台：商户账号管理，重置商户密码
- 商户端：商户登录和注销功能，修改个人密码
- 修改个人密码需要用到验证密码功能,
- 商户状态不是1正常，则商家账号不能登录

### 实现步骤

1.在平台端里  添加管理员管理做一个管理员表的curd 和一个登陆页面，登陆返回必须是平台模版的管理首页 

2.在平台端 创建商家用户管理 添加一个重置密码功能

```php
    if (Hash::check($request->post('password'), $admin->password)) {
                $request->user()->fill([
                    'password' => Hash::make($request->post('re_password'))
                ])->save();
                session()->flash("success", "密码修改成功");
                return redirect()->route('admin.index');
            } else {
                session()->flash("success", "旧密码不正确");
                return redirect()->back()->withInput();
            }xxxxxxxxxx    public function update(Request $request)    {        // Validate the new password length...//接收当前输入旧密码  与数据库的旧密码进行对比       if (Hash::check('plain-text', $hashedPassword)) {                 $request->user()->fill([            'password' => Hash::make($request->newPassword)        ])->save();    }}     }
```

商户登录注册

登录成功后再首页显示当前登录用户    引用Auth 显示当前登录用户名

```php
{{\Illuminate\Support\Facades\Auth::guard('admin')->user()->name}}
```

2.在商户登录时进行判断当前登录用户的状态，如过商家用户状态为禁用就不能登录

```php
               if(Auth::user()->status===0){
                       Auth::logout();
                       session()->flash("success","商家状态已警用");
                       return redirect()->back()->withInput();
                   }
```



# 遇见的问题

同时添加时有一个未成功

解决方案：事务回滚



```php
DB::transaction(function () {

 数据执行语句；

});

```



## DAY03

### 开发任务

商户端 
\- 菜品分类管理 
\- 菜品管理 
要求 
\- 一个商户只能有且仅有一个默认菜品分类 
\- 只能删除空菜品分类 
\- 必须登录才能管理商户后台（使用中间件实现） 
\- 可以按菜品分类显示该分类下的菜品列表 
\- 可以根据条件（按菜品名称和价格区间）搜索菜品

### 实现步骤 

1. 添加一个菜品分类管理 

   ##### 注意每个商家只能有一个默认分类

   添加分类是根据登录的商家进行添加

2. 删除分类时 进行怕判断 分类下是否有菜品 如果有菜品不能删除

3. 商家必须登录都才能实现所有功能 在控制器里添加一个base控制器判断是否有用户登录  模型必须继承    Authenticatable    每个控制器在继承base控制器

4. 在菜品类列表添加一类导航条 添加几个搜索表单 

5. 控制器 接收搜索值进行数据条件查找

   

# DAY04



### 开发任务



## 优化

将网站图片上传到阿里云OSS对象存储服务，以减轻服务器压力

使用webuploder图片上传插件，提升用户上传图片体验



### 平台

#### 平台活动管理（活动列表可按条件筛选 未开始/进行中/已结束 的活动）

#### 活动内容使用ueditor内容编辑器





### 商户端

#### 查看平台活动（活动列表和活动详情）

#### 活动列表不显示已结束的活动





## 实现步骤

图片上传阿里云

1.修改配置

```php
 //添加自己的阿里云oss

'oss' => [
                'driver'        => 'oss',
                'access_id'     => 'LTAIkutC9HFgfFDr',
                'access_key'    => 'WQeqwOPWwcuKhgMwdGF9BdbcyvfokR',
                'bucket'        => 'elm0325',
                'endpoint'      => 'oss-cn-shenzhen.aliyuncs.com',
```

1. uediter  文档步骤实行

2. 在平台上添加活动 

   在平台添加或动查询 

   ```php
     $date= date(now());
           $time=$request->get('status');
           if($time==-1){
               $query->where("start_time",'>=',$date);
           }
           if($time==1){
               $query->where("start_time",'<=',$date)->where("end_time",'<=',$date);
           }
           if($time==2){
               $query->where("end_time",'<=',$date);
           }
   ```

3. 在商家店铺查看正在进行中的活动 不显示已结束活动    在显示活动时 判断结束时间是否大小于当前时间

4. webuploader  看视频

   下载配置文件到public下

   引入视图而文件 

   引入视图所需要的样式 js css 

   在写 ajax 代码进行图片上传

   在控制器添加一个方法接收值 再用ajax 传值到表单中

   在视图里添加一个隐藏的表单  

# DAY05

  开发任务
  接口开发 

# DAY06

- 用户注册 
- 用户登录 
- 发送短信 
  要求 
- 存到redis,并设置有效期5分钟 
- 用户注册时,从redis取出验证码进行验证