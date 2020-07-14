<?php

namespace App\Http\Controllers\Component;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UploadController extends Controller
{
	//文件上传处理
	//路由地址 /component/uploader
	public function uploader(Request $request){

		//验证上传的文件有效性
		//判断文件是否存在于请求
		if ($request->hasFile('file')){

			$upload = $request->file('file');
			if($upload->isValid()){

				//修改了config下的filesystem文件,改了默认的local驱动保存位置,保存到public/upload
				//store()保存文件并返回文件驱动下的路径及文件名带后缀, 第一个参数为路径,第二参数为文件驱动,默认为local,路径已改为public/upload
				//这里返回的是/ymd/xxx,
				$path = $upload->store(date('ymd'));
				//asset()可以补全网站域名
				$path = asset('/upload/'.$path);

				//成功返回文件路径
				//hdjs的上传框架中规定了返回值,注意看说明
				return response()->json(['code'=>0, 'file'=>$path]);
			}else{
				return response()->json(['code'=>403, 'msg'=>$upload->getError()]);
			}
		}else{
			return response()->json(['code'=>1, 'msg'=>"上传失败"]);
		}

	}

	//文件列表
	//路由地址/component/filelists
	public function filelists(){
		return response()->json(['code'=>0,'data'=> '','page'=> '','message'=>'手动']);

	}
}
