<?php
/**
 *
 * @author woojuan
 * @email woojuan163@163.com
 * @copyright GPL
 * @version
 */
Route::group(['namespace'=>'Api'],function(){
	//显示标签信息
	Route::get('tags','ContentController@tags');
	//获取对应标签的视频列表
	Route::get('videos/{tid?}','ContentController@videos');
	//获取对应视频的分集列表
	Route::get('sets/{vid}','ContentController@sets');
	//获取推荐视频
	Route::get('commend/{row}','ContentController@commend');
	//获取热门视频
	Route::get('hot/{row}','ContentController@hot');
	//获取分集视频的播放地址
	Route::get('set/{sid}','ContentController@set');
});