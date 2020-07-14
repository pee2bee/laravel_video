<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Validator;
use Hash;

class AdminPost extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        //return false;
	    //判断该请求的用户是否已通过验证,返回true or false
	    return Auth::guard('admin')->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
	    //引入添加的规则,暂时不验证
	    //$this->addValidator();

    	//返回验证数组
	    //sometimes  有此字段才会验证
        return [
            //
	        "old_password"  =>  "sometimes|required",
	        "new_password"  =>  "sometimes|required|min:3|max:20|confirmed",
	        "new_password_confirmation"        =>  "sometimes|required"
        ];

    }
	/**
	 * 获取已定义验证规则的错误消息。
	 *
	 * @return array
	 */
	public function messages()
	{

		return [
			'old_password.required' => '原密码必须填写',
			'old_password.check_password' => '原密码错误',
			'new_password.required' => '新密码必须填写',
			'new_password.min'      => '新密码位数不能小于3',
			'new_password.max'      => '新密码位数不能大于20',
			'new_password.confirmed' => '两次新密码不一致',
		];
	}
	/**
	 * 添加自定义验证方法
	 */
	public function addValidator(){

		//验证用户密码
		Validator::extend('check_password', function ($attribute, $value, $parameters, $validator) {
			//哈希比较,值和密码的哈希比较
			return Hash::check($value,Auth::guard('admin')->user()->password);
		});
	}
}
