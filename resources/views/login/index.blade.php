<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../favicon.ico">
    <title>登陆</title>
    <link href="https://cdn.bootcss.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
    <link href="http://v3.bootcss.com/assets/css/ie10-viewport-bug-workaround.css" rel="stylesheet">
    <link href="http://v3.bootcss.com/examples/signin/signin.css" rel="stylesheet">
    <!--[if lt IE 9]>
    <script src="https://cdn.bootcss.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://cdn.bootcss.com/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body>
    <div class="container">
        <form class="form-signin" method="POST" action="/login">
            {{csrf_field()}}
            <h2 class="form-signin-heading">请登录</h2>
            <label for="inputEmail" class="sr-only">邮箱</label>
            <input type="email" name="email" id="inputEmail" class="form-control" placeholder="Email address" required autofocus>
            <label for="inputPassword" class="sr-only">密码</label>
            <input type="password" name="password" id="inputPassword" class="form-control" placeholder="Password" required>
            <div class="checkbox">
                <label>
                    <input type="checkbox" value="1" name="is_remember"> 记住我
                </label>
            </div>
            @include('layout.error')
            <button class="btn btn-lg btn-primary btn-block" type="submit">登陆</button>
            <a href="/regist" class="btn btn-lg btn-primary btn-block" type="submit">去注册>></a>
        </form>
    </div>
</body>
</html>