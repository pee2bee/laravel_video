<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Admin\CommonController;

class EntryController extends CommonController
{

    /**
     * 后台登录
     * */
	public function login(Request $request){

		//判断请求类型,post请求进行表单验证
		if($request -> method() === "POST"){
			//调用用户认证
			//更改使用的守卫(调用验证用的模型),默认用user
			//$status为true则查表验证成功
			$status = Auth::guard('admin')->attempt([
				'username'=> $request->input('username'),
				'password'=> $request->input('password'),
			]);

			/*返回方式1, 服务器端重定向
			if ($status){
				//登录成功,重定向
				//return redirect('admin/index');
			}else{
				//登录失败
				//认证失败 跳到登录页面
				return redirect('/admin/login') -> withErrors([
					'loginError' => '用户或密码错误.'
				]);
			}
			*/

			//返回方式2,ajax请求返回json数据
			if($status){
				//return ['code'=>0];
				return $this->success("登录成功");
			}else{
				return $this->fail("用户名或密码错误");
			}
		}

		//请求方法为get时,返回登录页
		if($request -> method() === "GET"){
			return view('admin.login');
		}
	}

	/**
	 * 请求处理,后台首页
	 * /admin/index
	 */
	public function index(){

		//后台权限验证
		//未登录不可访问,采用中间件来验证,已在构造函数中
		//返回首页
		//dd(Auth::guard('admin')->user()->username);//获取用户名称
		return view('admin.index');
	}

	/**
	 * 退出后台登陆
	 * /admin/logout
	 */
	public function logout(){

		//调用Auth门面的注销用户 logout()方法
		//会清除加到用户认证的session
		//这里采用的是admin的门卫,要调用admin的,默认是user的
		Auth::guard('admin')->logout();

		//返回登录页
		return redirect('/admin/login');
	}


}
