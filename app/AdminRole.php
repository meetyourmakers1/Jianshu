<?php

namespace App;

class AdminRole extends Model
{
    protected $table = 'admin_roles';

    //当前角色的所有权限
    public function permissions(){
        return $this->belongsToMany(\App\AdminPermission::class,'admin_role_permissions','role_id','permission_id')->withPivot(['role_id','permission_id']);
    }
    //给当前角色分配某个权限
    public function assignPermission($permission){
        return $this->permissions()->save($permission);
    }
    //删除当前角色的某个权限
    public function deletePermission($permission){
        return $this->permissions()->detach($permission);
    }
    //判断当前角色是否有某个权限
    public function hasPermission($permission){
        return $this->permissions->contains($permission);
    }
}
