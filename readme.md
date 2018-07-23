# DAY01

1.配置好三个虚拟主机：
admin.eleb.com
shop.eleb.com
www.eleb.com

2.数据迁移创建数据库
php artisan make:migration create_users_table
  $table->increments('id');
            $table->string('name');
            $table->string('airline');
            $table->timestamps();
 php artisan migrate
## 遇到的问题
# DAY02

## 1.增加管理员
## 2.实现登录和注销功能
## 3.修改密码 先输入旧密码，再输入2次新密码