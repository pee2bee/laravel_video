<?php
/**
 *
 * @author woojuan
 * @email woojuan163@163.com
 * @copyright GPL
 * @version
 */
//组件路由
Route::group(['prefix'=>'component','namespace'=>'Component'],function (){
	//1,上传图片组件路由
	//文件上传处理
	Route::post('uploader','UploadController@uploader');
	//文件上传列表
	Route::post('filelists','UploadController@filelists');

	//2,上传视频到阿里云oss
	Route::any('oss','OssController@sign');
});