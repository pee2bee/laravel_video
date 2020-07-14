<?php

namespace App\Http\Controllers\Api;

use App\Set;
use App\Tag;
use App\Video;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;

class ContentController extends Controller
{

	/**
	 * 返回标签内容 路由/api/tags/
	 *
	 * @return $this
	 */
	public function tags(){
		$data = Tag::get()->toArray();
		//要想直接返回中文,可以加后面,不然可能返回的是Unicode编码
		return response()->json($data)->setEncodingOptions(JSON_UNESCAPED_UNICODE);
	}

	//返回对应标签的视频列表
	public function videos($tid){
		//$data = Video::where('');
		//这里使用内连接 videos 表和 tag_videos关系表
		if($tid){
			$data = DB::table('videos')
				      ->select('videos.id','videos.title','videos.preview')
			          ->join('tag_videos', 'videos.id', '=', 'tag_videos.video_id')
			          ->where('tag_videos.tag_id','=',$tid)
			          ->get();
		}else{
			$data = Video::all()->toArray();
		}

		return response()->json($data)->setEncodingOptions(JSON_UNESCAPED_UNICODE);
	}

	//返回对应视频的分集列表
	public function sets($vid){

		$data = Set::where('video_id','=',$vid)->get()->toArray();
		//dd($data);
		return response()->json($data)->setEncodingOptions(JSON_UNESCAPED_UNICODE);
	}

	//返回推荐视频列表
	public function commend($row){

		//获取推荐的模型,并转为数组形式
		$data = Video::where('iscommend','=',1)->limit($row)->get()->toArray();
		//dd($data);
		return response()->json($data)->setEncodingOptions(JSON_UNESCAPED_UNICODE);
	}

	//返回热门视频列表
	public function hot($row){

		//获取热门的模型,并转换成数组
		//获取固定条数,还可以用take()->get()
		$data = Video::where('ishot','=',1)->take($row)->get()->toArray();
		return response()->json($data)->setEncodingOptions(JSON_UNESCAPED_UNICODE);
	}

	//返回分集播放地址
	public function set($sid){
		//find()获取的是模型对象
		$data = Set::find($sid)->toArray();
		//dd($data);
		//返回一条数据,json对象{}
		return response()->json($data)->setEncodingOptions(JSON_UNESCAPED_UNICODE);
	}
}
