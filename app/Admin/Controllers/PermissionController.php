<?php

namespace App\Admin\Controllers;

use \App\AdminPermission;
class PermissionController extends Controller
{
    //权限列表
    public function index(){
        $permissions = AdminPermission::paginate(5);
        return view('admin/permission/index',compact('permissions'));
    }
    //创建权限页面
    public function create(){
        return view('admin/permission/create');
    }
    //创建权限操作
    public function createHandle(){
        $this->validate(request(),[
            'name' => 'required|min:1',
            'description' => 'required',
        ]);
        AdminPermission::create(request(['name','description']));
        return redirect('/admin/permission');
    }
}