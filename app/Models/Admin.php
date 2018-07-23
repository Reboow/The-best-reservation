<?php

namespace App\Models;

use App\Providers\AuthServiceProvider;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Admin extends Authenticatable
{
    //可以修改的字段
    public $fillable=["name","password","email"];
}
