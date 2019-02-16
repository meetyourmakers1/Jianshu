<?php

namespace App\Admin\Controllers;

use App\AdminUser;
use App\AdminRole;

class UserController extends Controller
{
    //管理员列表首页
    public function index(){
        $users = AdminUser::paginate(5);
        return view('admin.user.index',compact('users'));
    }

    //管理员创建页面
    public function create(){
        return view('admin.user.create');
    }

    //管理员创建操作
    public function createHandle(){
        $this->validate(request(),[
            'name' => 'required|min:1',
            'password' => 'required|min:1'
        ]);
        $name = request('name');
        $password = bcrypt(request('password'));
        AdminUser::create(compact('name','password'));
        return redirect('admin/user');
    }

    //用户角色页面
    public function role(AdminUser $user){
        $roles = \App\AdminRole::all();
        $myRoles = $user->roles;
        return view('admin/user/role',compact('user','roles','myRoles'));
    }

    //保存用户角色操作
    public function roleHandle(AdminUser $user){
        $this->validate(request(),[
            'roles' => 'required|array',
        ]);
        $roles = AdminRole::findMany(request('roles'));
        $myRoles = $user->roles;
        //增加的角色
        $addRoles = $roles->diff($myRoles);
        foreach($addRoles as $role){
            $user->assignRole($role);
        }
        //删除的角色
        $deleteRoles = $myRoles->diff($roles);
        foreach($deleteRoles as $role){
            $user->deleteRole($role);
        }
        return back();
    }
}