<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LoginController extends Controller
{
    //用户登录
    public function index(){
        return view('login/index');
}
    //登录操作
    public function loginHandle(Request $request){
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required|min:5',
            'is_remember' => 'integer',
        ]);

        $user = request(['email', 'password']);
        $remember = boolval(request('is_remember'));
        if (true == \Auth::attempt($user, $remember)) {
            return redirect('/posts');
        }

        return \Redirect::back()->withErrors("用户名密码错误");
    }
    //登出操作
    public function logoutHandle(){
        \Auth::logout();
        return redirect('/login');
    }
}
