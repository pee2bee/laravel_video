<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\AdminPost;
use App\Http\Requests\TagRequest;
use App\Tag;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Response;

class TagController extends CommonController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
	    //获取标签列表
	    $data = Tag::all();
	    //dd($data);//结果集对象

	    return view('admin.tags.index')->with(compact('data'));
    }



	/** 展示添加标签表单
	 * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
	 */
	public function createForm(){
		return view('admin.tags.create');
	}

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(TagRequest $request)
    {

	    	//插入数据
		    //如果成功会返回一个model对象,失败返回null,可以用if(!result)来判断
		    //null、undefined、NaN、+0、-0、""，这六种转换成布尔类型是false，其余都是true,会自动转型
			$res = Tag::create(['name' => $request->input('name')]);
			if(!$res){
				return $this->fail('新增标签失败,请重试');
			}else{
				return $this->success('新增标签成功');
			}
    }

	/**
	 * 展示更新标签的表单
	 * @param TagRequest $request
	 *
	 * @return $this
	 */
	public function updateForm(TagRequest $request){

		//获取当前标签id
		$id = $request->input('id');
		//此标签数据
		$data = Tag::find($id);
		if ($data){
			return view('admin.tags.update')->with(compact('data'));
		}else{
			$this->fail("无此标签数据,请返回重试");
		}
	}

	/**
	 * 更新处理
	 * @param Request $request
	 *
	 * @return \Illuminate\Http\JsonResponse
	 */
    public function update(Request $request)
    {
	    //获取当前标签id
	    $id = $request->input('id');
	    //获取该记录模型
	    $data = Tag::find($id);
	    //更新数据
	    $data->name = $request->input('name');
	    $res = $data->save();
	    if ($res){
		    return $this->success("修改成功");
	    }else{
			return $this->fail("修改标签失败,请重试");
	    }
    }

	/**
	 * 删除标签
	 * @param TagRequest $request
	 *
	 * @return \Illuminate\Http\JsonResponse
	 * @throws \Exception
	 */
    public function delete(TagRequest $request)
    {
        //调用destroy(索引)直接删除

	    $res = Tag::where('id','=',$request->input('id'))->delete();

	    if ($res){
		    return $this->success("删除成功");
	    }else{
		    return $this->fail("删除失败请重试");
	    }
    }
}
