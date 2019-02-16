<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>AdminLTE 2 | Log in</title>
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <link rel="stylesheet" href="/adminlte/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
    <link rel="stylesheet" href="/adminlte/dist/css/AdminLTE.min.css">
    <link rel="stylesheet" href="/adminlte/plugins/iCheck/square/blue.css">
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
</head>
<body class="hold-transition login-page">
    <div class="login-box">
        <div class="login-logo">
            <a href="/adminlte/index2.html">ylaravel管理后台</a>
        </div>
        <div class="login-box-body">
            <p class="login-box-msg">登陆</p>
            <form action="/admin/login" method="post">
                {{csrf_field()}}
                <div class="form-group has-feedback">
                    <input name="name" type="text" class="form-control" placeholder="名字">
                    <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                </div>
                <div class="form-group has-feedback">
                    <input name="password" type="password" class="form-control" placeholder="密码">
                    <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                </div>
                @include("admin.layout.error")
                <div class="row">
                    <div class="col-xs-4">
                        <button type="submit" class="btn btn-primary btn-block btn-flat">登陆</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <script src="/adminlte/plugins/jQuery/jquery-2.2.3.min.js"></script>
    <script src="/adminlte/bootstrap/js/bootstrap.min.js"></script>
    <script src="/adminlte/plugins/iCheck/icheck.min.js"></script>
    <script>
        $(function () {
            $('input').iCheck({
                checkboxClass: 'icheckbox_square-blue',
                radioClass: 'iradio_square-blue',
            });
        });
    </script>
</body>
</html>
