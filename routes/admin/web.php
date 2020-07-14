<?php
/**
 *
 * @author woojuan
 * @email woojuan163@163.com
 * @copyright GPL
 * @version
 */
// 后台处理
Route::group(['prefix'=>'admin','namespace'=>'Admin'],function(){

	//1,后台登录视图
	Route::get('login','EntryController@login');
	//后台登录表单处理
	Route::post('login','EntryController@login');
	//后台首页
	Route::get('index','EntryController@index');
	//退出登录
	Route::get('logout','EntryController@logout');


	//2,修改用户密码,视图页
	Route::get('account/edit','AccountController@edit');
	//修改用户密码,表单处理
	Route::post('account/edit','AccountController@edit');


	//3,视频标签管理 获取列表
	Route::get('tags/index','TagController@index');

	//展示增加标签createform表单
	Route::get('tags/create','TagController@createForm');
	//create表单处理
	Route::post('tags/create','TagController@create');
	//更新标签表单视图
	Route::get('tags/update','TagController@updateForm');
	//更新标签处理
	Route::post('tags/update','TagController@update');
	//删除标签
	Route::post('tags/delete','TagController@delete');

	//4,视频资源管理
	Route::resource('videos','VideoController');

});




