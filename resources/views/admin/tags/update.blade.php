@extends("admin.common.header")
@section("body")
<div class="layui-fluid">
    <div class="layui-row">
        <form class="layui-form">
            {{csrf_field()}}
            <div class="layui-form-item">
                <input type="text" style="display: none" name="id" value="{{$data->id}}}">
                <label for="L_pass" class="layui-form-label">
                    新标签名
                </label>
                <div class="layui-input-inline">
                    <input type="text" id="name" name="name" required=""lay-verify="name" placeholder="{{$data->name}}"
                           autocomplete="off" class="layui-input">
                </div>
                <div class="layui-form-mid layui-word-aux">
                    2到20个字符
                </div>
                <button  class="layui-btn" lay-filter="edit" lay-submit="">
                    修改
                </button>
            </div>


        </form>
    </div>
</div>
<script>
    layui.use(['form', 'layer'],
        function() {
            $ = layui.jquery;
            var form = layui.form,
                layer = layui.layer;

            //自定义验证规则
            form.verify({
                name: [/(.+){2,20}$/, '标签必须2到20位'],
            });

            //监听提交
            form.on('submit(edit)',
                function(data) {
                    console.log(data);


                    //，把数据提交给php
                    $.ajax({
                        url:'/admin/tags/update',
                        type:'post',
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

</script>
@endsection