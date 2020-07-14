<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class TagRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
    	//发起该请求的用户 登录验证
        return Auth::guard('admin')->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            //标签名是否合规
	        "name" => "sometimes|required|min:2|max:20"
        ];
    }

	/**
	 * 获取已定义规则的错误信息并返回对应中文
	 * @return array
	 */
    public function messages() {
	    return [
	    	"name.required"   =>  "标签名不能为空",
		    "name.min"        =>  "标签名不能少于两个字符",
		    "name.max"        =>  "标签名不能大于20个字符"
	    ];
    }
}
