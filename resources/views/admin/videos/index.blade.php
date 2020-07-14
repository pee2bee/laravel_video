@extends('admin.common.header')
@section('body')

    <div class="layui-fluid">
        <div class="layui-row layui-col-space15">
            <div class="layui-col-md12">
                <div class="layui-card">

                    <div class="layui-card-header">
                        <button class="layui-btn layui-btn-danger" onclick="xadmin.open('新增视频','/admin/videos/create')"><i class="layui-icon"></i>新增视频</button>
                    </div>
                    <div class="layui-card-body ">
                        <table class="layui-table layui-form">
                            <thead>
                            <tr>
                                <th>
                                    <input type="checkbox" name=""  lay-skin="primary">
                                </th>
                                <th>ID</th>
                                <th>视频名称</th>
                                <th>简介</th>
                                <th>预览图</th>
                                <th>数量</th>
                                <th>操作</th></tr>
                            </thead>
                            <tbody>
                            @foreach($data as $key => $value)
                                <tr>

                                    <td>{{$value['id']}}</td>
                                    <td>{{$value['title']}}</td>
                                    <td>{{$value['introduce']}}</td>
                                    <td><img src="{{$value['preview']}}" alt="预览图"></td>
                                    <td>{{$value->sets()->count()}}</td>

                                    <td class="td-manage">
                                        &nbsp;&nbsp;&nbsp;
                                        <a title="编辑" onclick='xadmin.open("修改视频","/admin/videos/{{$value->id}}/edit")'>
                                            <i class="layui-icon">&#xe642;</i>
                                        </a>
                                        &nbsp;&nbsp;&nbsp;
                                        <a title="删除" onclick="member_del(this,{{$value->id}})" href="javascript:;">
                                            <i class="layui-icon">&#xe640;</i>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach

                            </tbody>
                        </table>
                    </div>
                    <div class="layui-card-body ">
                        <div class="page">
                            <div>
                                <a class="prev" href="">&lt;&lt;</a>
                                <a class="num" href="">1</a>
                                <span class="current">2</span>
                                <a class="num" href="">3</a>
                                <a class="num" href="">489</a>
                                <a class="next" href="">&gt;&gt;</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        layui.use(['laydate','form'], function(){
            var laydate = layui.laydate;

            //执行一个laydate实例
            laydate.render({
                elem: '#start' //指定元素
            });

            //执行一个laydate实例
            laydate.render({
                elem: '#end' //指定元素
            });
        });


        /*用户-删除*/
        function member_del(obj,id){

            console.log(id)
            layer.confirm('确认要删除吗？',function (){

                //发异步删除数据
                $.ajax({
                    url:"/admin/videos/"+id,
                    type:"delete",
                    data:null,
                    dataType:"JSON",
                    success:function(res){
                        //res.code=0为删除成功,其他失败
                        if (res.code){
                            //code == 1,提示失败
                            layer.alert('删除失败,请重试');
                        }else{
                            //移除元素
                            $(obj).parents("tr").remove();
                            layer.msg('已删除!',{icon:1,time:1000});
                        }
                    },
                    error:function(res){
                        console.log(res);
                        //显示服务器响应错误信息
                        layer.alert(res.responseText)
                    }
                })
            })

        }




    </script>

@endsection