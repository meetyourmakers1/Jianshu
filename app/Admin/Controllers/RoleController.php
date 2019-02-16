<?php

namespace App\Admin\Controllers;

use \App\AdminRole;
use \App\AdminPermission;

class RoleController extends Controller
{
    //角色列表
    public function index(){
        $roles = AdminRole::paginate(5);
        return view('admin/role/index',compact('roles'));
    }
    //创建角色页面
    public function create(){
        return view('admin/role/create');
    }
    //创建角色操作
    public function createHandle(){
        $this->validate(request(),[
            'name' => 'required|min:1',
            'description' => 'required',
        ]);
        AdminRole::create(request(['name','description']));
        return redirect('/admin/role');
    }
    //角色权限页面
    public function permission(AdminRole $role){
        $permissions = AdminPermission::all();
        $rolePermissions = $role->permissions;
        return view('admin/role/permission',compact('role','permissions','rolePermissions'));
    }
    //保存角色权限操作
    public function permissionHandle(AdminRole $role){
        $this->validate(request(),[
            'permissions' => 'required|array',
        ]);
        $permissions = AdminPermission::findMany(request('permissions'));
        $rolePermissions = $role->permissions;
        //增加的权限
        $addPermissions = $permissions->diff($rolePermissions);
        foreach($addPermissions as $permission){
            $role->assignPermission($permission);
        }
        //删除的权限
        $deletePermissions = $rolePermissions->diff($permissions);
        foreach($deletePermissions as $permission){
            $role->deletePermission($permission);
        }
        return back();
    }
}