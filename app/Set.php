<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Set extends Model
{
	//Eloquent 模型都针对批量赋值（Mass-Assignment）做了保护。
	//添加fillable属性(可填充字段数组)
	//或guarded属性(排除要保护字段数组)
	protected $guarded = [];//要保护的字段设为空
}
