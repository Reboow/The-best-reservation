<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BaseController extends Controller
{
    //同源策略
        public function __construct()
        {
            header( "Access-Control-Allow-Origin:*");
        }
}
