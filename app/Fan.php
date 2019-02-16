<?php

namespace App;

use App\Model as Model;

class Fan extends Model
{
    //粉丝用户信息
    public function fansUser(){
        return $this->hasOne(\App\User::class,'id','fans_id');
    }
    //关注用户信息
    public function starUser(){
        return $this->hasOne(\App\User::class,'id','star_id');
    }
}
