<?php

namespace App\Http\Controllers\Admin;


use App\Admin;
use App\Http\Controllers\Controller;
use App\Http\Requests\AdminPost;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Hash;

class AccountController extends CommonController
{
    //后台用户控制器

	/**
	 * 修改用户密码
	 * /admin/account-edit
	 * 类型提示传入请求,会自动验证请求,错误会保存在$errors  (数组)中
	 */
	public function edit(AdminPost $request){


		if($request -> method() == "GET"){

			//get请求展示视图
			return view('admin.account.edit');
		}elseif($request -> method() == "POST"){

			//post请求
			//1,判断原密码是否正确
			//请求中的原密码的md5 用laravel的bcrypt()跟获取用户中的密码进行比较
			//使用Hash::check来比较
			//2,更新密码
			if(Hash::check($request->input('old_password'), Auth::guard('admin')->user()->password) ){
				$data = ['code' => 0];

				//更新密码,$admin为模型
				$admin = Auth::guard('admin')->user();
				//修改
				$admin->password = bcrypt($request->input('new_password'));
				//保存修改
				$admin->save();
			}else{
				//验证不成功,原密码错误
				$data = ['code' => 1];
			}

			return Response::json($data);

		}

	}
}
