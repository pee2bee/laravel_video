<!DOCTYPE html>
<html class="x-admin-sm">

<head>
    <meta charset="UTF-8">
    <title>后台管理</title>
    <meta name="renderer" content="webkit">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!--xadmin-->
    <meta name="viewport" content="width=device-width,user-scalable=yes, minimum-scale=0.4, initial-scale=0.8,target-densitydpi=low-dpi" />
    <link rel="stylesheet" href="/xadmin/css/font.css">
    <link rel="stylesheet" href="/xadmin/css/xadmin.css">
    <script type="text/javascript" src="/xadmin/lib/layui/layui.js" charset="utf-8"></script>
    <script type="text/javascript" src="/xadmin/js/xadmin.js"></script>
    <script type="text/javascript" src="/js/vue.js"></script>
    <!-- 让IE8/9支持媒体查询，从而兼容栅格 -->
    <!--[if lt IE 9]>
    <script src="https://cdn.staticfile.org/html5shiv/r29/html5.min.js"></script>
    <script src="https://cdn.staticfile.org/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    {{--<!--引入webuploader-->--}}
    {{--<!--引入CSS-->--}}
    {{--<link rel="stylesheet" type="text/css" href="/node_modules/webuploader/webuploader.css">--}}
    {{--<!--引入JS-->--}}
    {{--<script type="text/javascript" src="/node_modules/webuploader/webuploader.js"></script>--}}


    <!--HDJS-->
    <link href="https://cdn.bootcss.com/twitter-bootstrap/4.1.3/css/bootstrap.min.css" rel="stylesheet">
    <script>
        window.hdjs = {};
        //hdjs路径,绝对路径
        window.hdjs.base = '/node_modules/hdjs';
        //后台请求地址,路由地址
        window.hdjs.uploader = '/component/uploader?';
        //文件列表地址,路由地址,后面会自动追加上传的类型&type=,所有要带?
        window.hdjs.filesLists = '/component/filelists?';

    </script>
    <script src="/node_modules/hdjs/require.js"></script>
    <script src="/node_modules/hdjs/config.js"></script>


</head>
<script >
    layui.use(['form', 'layer'],
        function() {
            $ = layui.jquery;
            $.ajaxSetup({
                headers: {
                    // meta 标签，可以使用类似 jQuery 的库将令牌自动添加到所有请求的头信息中
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
        })

</script>
<body>
@yield('body')
</body>

</html>