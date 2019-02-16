<?php

namespace App;

class AdminPermission extends Model
{
    protected $table = 'admin_permissions';

    //当前权限属于哪些角色
    public function roles(){
        return $this->belongsToMany(\App\AdminRole::class,'admin_role_permissions','permission_id','role_id')->withPivot(['role_id','permission_id']);
    }
}
