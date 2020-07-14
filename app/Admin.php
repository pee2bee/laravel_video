<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

//继承验证的user类,直接用她的用户验证方法,不用再重写验证方法
use Illuminate\Foundation\Auth\User as Authenticatable;
class Admin extends Authenticatable
{
    //新建remenbertoken 字段,为空,勾选记住我,可以用来保存数据
	protected $rememberTokenName = "";
}
