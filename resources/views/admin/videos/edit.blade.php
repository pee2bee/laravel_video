@extends('admin.common.header')
@section('body')


    <div class="layui-fluid">
        <div class="layui-row layui-col-space15">
            <div class="layui-col-md12" style="background-color: #5e8571">
                <div class="layui-card" id="app">
                    <form class="layui-form" action="" >
                        <div class="layui-card-header">添加视频</div>
                        <div class="layui-card-body">
                            <div class="layui-card">
                                <div class="layui-card-header">系列管理</div>
                                <div class="layui-card-body">
                                    <div class="layui-form-item">
                                        <label class="layui-form-label">视频系列名称</label>
                                        <div class="layui-input-block">
                                            <input type="text" name="video_title" value="{{$video['title']}}"   placeholder="视频系列名称" autocomplete="off" class="layui-input">
                                        </div>
                                    </div>
                                    <div class="layui-form-item layui-form-text">
                                        <label class="layui-form-label">缩略图</label>
                                        <div class="layui-input-block">
                                            <div class="layui-input-inline">
                                                <img src="{{asset('/image/default.jpg')}}" class="img-responsive img-thumbnail" width="150">
                                                <em class="close" style="position: absolute;top: 3px;right: 8px;" title="删除这张图片"
                                                    onclick="removeImg(this)">×</em>
                                            </div>
                                            <div id="fileList" class="uploader-list"></div>
                                            <input type="text"class="layui-input" name="video_preview" value="{{$video['preview']}}" >
                                            <button onclick="upImagePc(this)" class="btn btn-secondary" type="button">单图上传</button>
                                        </div>
                                    </div>
                                    <div class="layui-form-item layui-form-text">
                                        <label class="layui-form-label">视频标签</label>
                                        <div class="layui-input-block">
                                            <select name="tag" lay-verify="">
                                                <option value="">请选择一个标签</option>
                                                <option value="010">北京</option>
                                                <option value="021">上海</option>
                                                <option value="0571">杭州</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="layui-form-item layui-form-text">
                                        <label class="layui-form-label">视频系列简介</label>
                                        <div class="layui-input-block">
                                            <textarea name="video_introduce" placeholder="请输入系列的简介" class="layui-textarea" >{{$video['introduce']}}</textarea>
                                        </div>
                                    </div>


                                    <div class="layui-form-item">
                                        <label class="layui-form-label">热门</label>
                                        <div class="layui-input-block">
                                            <input type="checkbox"value="{{$video['ishot']}}" name="video_ishot" lay-skin="switch" <?php if ($video['ishot']) echo 'checked '; ?>>
                                        </div>
                                    </div>
                                    <div class="layui-form-item">
                                        <label class="layui-form-label">推荐</label>
                                        <div class="layui-input-block">
                                            <input type="checkbox" value="{{$video['iscommend']}}" name="video_iscommend" lay-skin="switch"<?php if ($video['iscommend']) echo 'checked'; ?>>
                                        </div>
                                    </div>
                                    <div class="layui-form-item">
                                        <label class="layui-form-label">点击量</label>
                                        <div class="layui-input-block">
                                            <input type="text"class="layui-input" name="video_click" value="{{$video['click']}}">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="layui-card">
                                <div class="layui card-header">分集管理</div>
                                <div class="layui-card-body">
                                    <div class="layui-card" v-for="(v,k) in sets">
                                        <div class="layui-card-body">
                                            <div class="layui-form-item">
                                                <label class="layui-form-label">分集名称</label>
                                                <div class="layui-input-block">
                                                    <input type="text" name="set_title"  v-model="v.title"    placeholder="视频系列名称" class="layui-input">
                                                </div>
                                            </div>

                                            <div class="layui-form-item" :id="'c'+v.id" >
                                                <label class="layui-form-label">分集链接</label>
                                                <div class="layui-input-block">
                                                    <div class="layui-input-inline" >
                                                        <input type="text" name="set_path" :id="'path'+v.id"  v-model="v.path"   placeholder="视频分集连接" class="layui-input">
                                                    </div>
                                                    <span >
                                            <button class="layui-btn"  :id="'pick'+v.id" type="button">选择分集</button>
                                            </span>
                                                    <span >
                                            <button class="layui-btn"  :id="'up'+v.id" type="button">上传</button>
                                            </span>
                                                    <div   :id="'progress'+v.id" style="display: none">
                                                        上传进度: <b></b>
                                                    </div>

                                                </div>

                                            </div>
                                            <div class="layui-form-item">
                                                <div class="layui-input-block">
                                                    <button class="layui-btn " @click.prevent="del(k)">删除分集</button>
                                                </div>
                                            </div>
                                            <div class="layui-form-item">
                                                <div class="layui-input-block">
                                                    <textarea name="sets"  >@{{sets}}</textarea>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="layui-card">
                                        <div >
                                            <button  class="layui-btn" @click.prevent="addSet">新增分集</button>
                                        </div>
                                    </div>

                                </div>
                            </div>


                            <div class="layui-card">
                                <div class="layui-form-item">
                                    <div class="layui-input-block">
                                        <button class="layui-btn" lay-submit lay-filter="save" >更新数据</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>


    </div>
    </div>
    </div>

    <script>

        //实例化vue,动态增删元素
        var vm = new Vue({
            el:"#app",
            data:{
                {{--//{!!!!} 不支持转移  一段html代码可以被正常的解析--}}
                //JSON.parse('')把返回的JSON字符串，构造由字符串描述的JavaScript值或对象
                sets:JSON.parse('{!! $sets !!}'),
            },
            methods:{
                addSet(){
                    //添加分集表单, 为每个表单绑定数据和id
                    //Date.parse(),把时间字符串转为时间戳(毫秒)
                    var field = {title:'',path:'',id:Date.parse(new Date())};
                    //把表单数据添加到sets数组后面
                    this.sets.push(field)

                    //为上传oss按钮绑定上传事件,确保前面的赋值完成,所以设个延时
                    setTimeout(function(){
                        //调用upload()
                        console.log('延时');
                        upload(field);
                    },200)

                },
                del(k){
                    //删除数组元素,splice直接对原数组进行操作,参数为索引值和个数
                    this.sets.splice(k,1);
                },

            }
        })
        //上传视频到阿里云oss
        function upload(field){
            //引入oss模块,这里用的是hdjs框架里面提供的
            require(['oss'],function (oss) {
                oss.upload({
                    //容器
                    container: 'c'+field.id,
                    //文件选择按钮
                    pick: 'pick'+field.id,
                    //开始上传按钮
                    upButton: 'up'+field.id,
                    //获取签名
                    serverUrl: '/component/oss?',
                    //上传目录
                    dir: 'video/',
                    //local_name本地文件名 random_name随机文件名
                    name_type: 'local_name',
                    //允许上传类型
                    filters: {
                        //文件类型
                        mime_types: [
                            //只允许上传图片和zip,rar文件
                            {title: "Image files", extensions: "jpg,gif,png,bmp,jpeg"},
                            {title: "Zip files", extensions: "zip,rar"},
                            {title: "Video", extensions: "mp4,avi,mov,rmvb,rm,wmv,flv,mp4,3gp"}
                        ],
                        //最大只能上传10000mb的文件
                        max_file_size: '10000mb',
                        //不允许选取重复文件
                        prevent_duplicates: true
                    },
                    event: {
                        //选择文件
                        select: function (file) {
                            $('#path').html('0%');
                        },
                        //开始上传
                        start: function (up, file) {

                            $('#progress').hidden=false;
                            console.log('开始上传');
                        },
                        progress: function (up, file) {
                            //上传进度

                            console.log(field.id);
                            $("#progress"+ field.id ).show().find('b').text(file.percent+"%");
                        },
                        success: function (up, file, info) {
                            //$("#path"+field.id).val('http://laravelvideo-51coode-com.oss-cn-shenzhen.aliyuncs.com/'+file.name);
                            //不知道为什么上面的值不能同步到path,下面再手动赋值一次
                            field.path ='http://laravelvideo-51coode-com.oss-cn-shenzhen.aliyuncs.com/'+file.name;
                            //console.log(up);
                            //console.log(info);
                            //$("h1").remove();
                            console.log(oss.oss)
                        },
                        error: function (up, file, info) {
                            alert(info.response);
                        }
                    }
                });
            })
        }


        //表单验证,异步上传更新数据
        layui.use(['form', 'layer'],
            function() {
                $ = layui.jquery;
                var form = layui.form,
                    layer = layui.layer;

                //自定义验证规则
                form.verify({

                });

                //监听提交
                form.on('submit(save)',
                    function(data) {
                        console.log(data);
                        data.field

                        //，把数据提交给php
                        $.ajax({
                            url:'/admin/videos/{{$video['id']}}',
                            type:'put',
                            data:data.field,
                            dataType:"JSON",
                            success:function(res){
                                console.log(res);
                                if(res.code){
                                    //code == 1,提示失败
                                    layer.alert(res.msg);
                                }else{
                                    //code == 0 提示修改成功,关闭窗口,刷新页面
                                    layer.alert(res.msg, {
                                            icon: 6
                                        },
                                        function() {
                                            //关闭当前frame
                                            xadmin.close();

                                            // 对父窗口进行刷新
                                            xadmin.father_reload();
                                        });
                                }
                            },
                            error: function(res){
                                console.log(res);
                                //显示错误信息
                                layer.alert(res.responseText)
                            }
                        })
                        return false;
                    });

            });

        //异步上传图片
        require(['hdjs']);
        //上传图片
        function upImagePc() {
            require(['hdjs'], function (hdjs) {
                var options = {
                    multiple: false,//是否允许多图上传
                };
                hdjs.image(function (images) {
                    console.log(images);
                    //上传成功的图片，数组类型
                    $("[name='video_preview']").val(images[0]);
                    $(".img-thumbnail").attr('src', images[0]);
                }, options)
            });
        }
        //移除图片
        function removeImg(obj) {
            $(obj).prev('img').attr('src', '{{asset("/image/default.jpg")}}');
            $(obj).parent().parent().find('input').val('{{asset("/image/default.jpg")}}');
        }


    </script>
@endsection

