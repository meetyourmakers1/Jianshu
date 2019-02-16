<?php

namespace App\Admin\Controllers;

class LoginController extends Controller
{
    //登录页面
    public function index(){
        return view('admin.login.index');
    }

    //登录操作
    public function loginHandle(){
        $this->validate(request(), [
            'name' => 'required',
            'password' => 'required',
        ]);

        $user = request(['name', 'password']);
        if (true == \Auth::guard('admin')->attempt($user)) {
            return redirect('/admin/home');
        }
        return \Redirect::back()->withErrors("用户名密码错误");
    }

    //登出操作
    public function logout(){
        \Auth::guard('admin')->logout();
        return redirect('/admin/login');
    }
}