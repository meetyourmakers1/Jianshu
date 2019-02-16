<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\User;

class RegistController extends Controller
{
    //用户注册
    public function index(){
        return view('regist/index');
    }
    //注册操作
    public function registHandle(){
        $this->validate(request(),[
            'name' => 'required|min:5|unique:users,name',
            'email' => 'required|unique:users,email|email',
            'password' => 'required|min:5|confirmed',
        ]);

        $name = request('name');
        $email = request('email');
        $password = bcrypt(request('password'));
        $user = User::create(compact('name', 'email', 'password'));
        return redirect('/login');
    }
}
