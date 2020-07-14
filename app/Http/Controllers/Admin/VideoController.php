<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\VideoRequest;
use App\Set;
use App\Tag;
use App\TagVideo;
use App\Video;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Admin\CommonController;

class VideoController extends CommonController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Video $video)
    {
        //视频列表,路由 admin/videos 请求方法get
	    //get()可以返回数组
	    //all()也可以返回数组,只是不能加where()等修饰
	    //laravel里get()得到的是一组数据，first()得到的是一个model数据
	    $data = $video->get();
	    //dd($data);
	    return view('admin.videos.index',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //新增视频视图, 路由admin/videos/create,请求方法get
		//获取标签列表,返回给视图
	    $data = Tag::get();

	    return view('admin.videos.create')->with(compact('data'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(VideoRequest $request,Video $video)
    {
        //保存新增视频,路由admin/videos 请求方法 post
	    //对模型字段进行赋值
	    try{
	    	//video表
		    $video['title']     = $request['video_title'];
		    $video['introduce'] = $request['video_introduce'];
		    $video['preview']   = $request['video_preview'];
		    $video['iscommend'] = $request['video_iscommend']? 1 : 0;
		    $video['ishot']     = $request['video_ishot']? 1 : 0;
		    $video['click']     = $request['video_click'];
		    $video->save();

		    //关联set表更新发过来的是json数据,要转为数组
		    //json_decode(),第二个参数为true时返回数组而非对象
		    //一般json_encode()返回为字符串,json_encode()返回为对象
		    $sets = json_decode($request['sets'],true);

		    //向set表中插入关联数据
		    if (!empty($sets)){

			    foreach($sets as $set){
				    $res = $video->sets()->create([
					    'title' => $set['title'],
					    'path'  => $set['path']
				    ]);
			    }
		    }

		    //向tagVideo表中插入关联数据
		    $tag = $request['tag'];
		    if (!empty($tag)){
		    	TagVideo::create(['tag_id'=>$tag,'video_id'=>$video->id]);
		    }

			//dd($res);
		    return $this->success('新增视频成功');
	    }catch (\Exception $e){
	    	return $this->fail($e->getMessage());
	    }



    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //展示更新视图 路由/admin/videos/{photo}/edit
		//获取该id对应的数据
	    //find($id)需要一个id并返回一个模型
	    $video = Video::find($id);
	    //获取关联的sets 数据
	    //前台用vue控制的sets,需要返回json数据
	    $sets = json_encode($video->sets()->get()->toArray(),JSON_UNESCAPED_UNICODE);
	    //返回数据
	    return view('admin.videos.edit',compact('video','sets'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //更新,路由/admin/videos/{id} 方法put patch
	    try{
	    	$video = Video::find($id);
		    //video表
		    $video['title']     = $request['video_title'];
		    $video['introduce'] = $request['video_introduce'];
		    $video['preview']   = $request['video_preview'];
		    $video['iscommend'] = $request['video_iscommend']? 1 : 0;
		    $video['ishot']     = $request['video_ishot']? 1 : 0;
		    $video['click']     = $request['video_click'];
		    $video->save();

		    //先删除分集数据库的关联的记录
		    Set::where('video_id','=',$id)->delete();
		    //关联set表更新发过来的是json数据,要转为数组
		    //json_decode(),第二个参数为true时返回数组而非对象
		    $sets = json_decode($request['sets'],true);

		    //判断sets是否为空
		    if(!empty($sets)){
			    //向set表中插入关联数据
			    foreach($sets as $set){
				    $res = $video->sets()->create([
					    'title' => $set['title'],
					    'path'  => $set['path']
				    ]);
			    }
		    }

		    //dd($res);
		    return $this->success('更新视频成功');
	    }catch (\Exception $e){
		    return $this->fail($e->getMessage());
	    }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //删除,路由/admin/videos/{video} 请求方式delete
		try{
			//分别删除video set表记录
			Video::destroy($id);
			Set::where('video_id','=',$id)->delete();
			return $this->success("删除视频成功");
		}catch(\Exception $exception){
			return $this->fail($exception->getMessage());
		}



    }
}
