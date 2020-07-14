<!DOCTYPE html>
<html class="x-admin-sm">

<head>
    <meta charset="UTF-8">
    <title>欢迎页面-X-admin2.2</title>
    <meta name="renderer" content="webkit">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width,user-scalable=yes, minimum-scale=0.4, initial-scale=0.8,target-densitydpi=low-dpi" />
    <link rel="stylesheet" href="/xadmin/css/font.css">
    <link rel="stylesheet" href="/xadmin/css/xadmin.css">
    <script type="text/javascript" src="/xadmin/lib/layui/layui.js" charset="utf-8"></script>
    <script type="text/javascript" src="/xadmin/js/xadmin.js"></script>
    <!-- 让IE8/9支持媒体查询，从而兼容栅格 -->
    <!--[if lt IE 9]>
    <script src="https://cdn.staticfile.org/html5shiv/r29/html5.min.js"></script>
    <script src="https://cdn.staticfile.org/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body>
<div class="layui-fluid">
    <div class="layui-row">
        <form class="layui-form">
            {{csrf_field()}}}

            <div class="layui-form-item">
                <label for="L_pass" class="layui-form-label">
                    <span class="x-red">*</span>原密码
                </label>
                <div class="layui-input-inline">
                    <input type="password" id="oldPass" name="old_password" required=""
                           autocomplete="off" class="layui-input">
                </div>
                <div class="layui-form-mid layui-word-aux">
                    3到16个字符
                </div>
            </div>
            <div class="layui-form-item">
                <label for="L_pass" class="layui-form-label">
                    <span class="x-red">*</span>新密码
                </label>
                <div class="layui-input-inline">
                    <input type="password" id="L_pass" name="new_password" required="" lay-verify="new_password"
                           autocomplete="off" class="layui-input">
                </div>
                <div class="layui-form-mid layui-word-aux">
                    3到16个字符
                </div>
            </div>
            <div class="layui-form-item">
                <label for="L_repass" class="layui-form-label">
                    <span class="x-red">*</span>确认密码
                </label>
                <div class="layui-input-inline">
                    <input type="password" id="L_repass" name="new_password_confirmation" required="" lay-verify="new_password_confirmation"
                           autocomplete="off" class="layui-input">
                </div>
            </div>
            <div class="layui-form-item">
                <label for="L_repass" class="layui-form-label">
                </label>
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

                    new_password: [/(.+){3,20}$/, '密码必须3到20位'],
                    new_password_confirmation: function(value) {
                        if ($('#L_pass').val() != $('#L_repass').val()) {
                            return '两次密码不一致';
                        }
                    }
                });

                //监听提交
                form.on('submit(edit)',
                    function(data) {
                        console.log(data);


                        //，把数据提交给php
                        $.ajax({
                            url:'/admin/account/edit',
                            type:'post',
                            data:data.field,
                            dataType:"JSON",
                            success:function(res){
                                console.log(res);
                                if(res.code){
                                    //code == 1,提示失败
                                    layer.alert('原密码错误,请重试');
                                }else{
                                    //code == 0 提示修改成功,关闭窗口,刷新页面
                                    layer.alert("修改成功", {
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
                            error: function(){
                                layer.alert("连接失败请检查网络")
                            }
                        })
                        return false;
                    });

            });

    </script>

</body>

</html>
