<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Response;

/**
 * 抽象后台公共类,后台控制器都继承他的方法
 * Class CommonController
 * @package App\Http\Controllers\Admin
 */
abstract class CommonController extends Controller
{

	/**
	 * 构造函数
	 */
	public function __construct(){

		//调用中间件
		//验证是否已登录,使用后台所有控制器方法都要登录
		$this->middleware('admin.auth')->except("login");
	}

	/**
	 *操作成功返回 json数据
	 * code 为 0
	 */
	protected function success($msg){
		//return ['code'=>0];
		return response()->json(["code"=>0,"msg"=> $msg]);
	}

	protected function fail($msg){
		return response()->json(["code"=>1,"msg"=> $msg]);
	}

}
