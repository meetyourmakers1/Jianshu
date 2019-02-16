<?php

namespace App;

use App\Model as Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class AdminUser extends Authenticatable
{
    protected $rememberTokenName = '';

    protected $guarded = [];

    //当前用户的所有角色
    public function roles(){
        return $this->belongsToMany(\App\AdminRole::class,'admin_user_roles','user_id','role_id')->withPivot(['user_id','role_id']);
    }
    //判断当前用户是否有某个角色
    public function hasRoles($roles){
        return !!$roles->intersect($this->roles)->count();
    }
    //给当前用户分配某个角色
    public function assignRole($role){
        return $this->roles()->save($role);
    }
    //删除当前用户的某个角色
    public function deleteRole($role){
        return $this->roles()->detach($role);
    }
    //判断当前用户是否有某个权限
    public function hasPermission($permission){
        return $this->hasRoles($permission->roles);
    }
}
